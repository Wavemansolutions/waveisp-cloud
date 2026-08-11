<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentActivationService;
use App\Services\PaystackService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function callback(Request $request, PaystackService $paystack, PaymentActivationService $activation)
    {
        $reference = $request->query('reference');

        if (blank($reference)) {
            return redirect()
                ->route('portal.plans')
                ->with('error', 'No payment reference was returned.');
        }

        $payment = Payment::where('reference', $reference)->firstOrFail();

        $result = $this->verifyAndActivate($payment, $paystack, $activation);

        return redirect()
            ->route('payment.success', $payment)
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function webhook(Request $request, PaystackService $paystack, PaymentActivationService $activation)
    {
        $secret = config('services.paystack.secret_key');
        $signature = $request->header('x-paystack-signature');
        $computed = hash_hmac('sha512', $request->getContent(), $secret);

        if (! hash_equals($computed, (string) $signature)) {
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $payload = $request->json()->all();
        $event = $payload['event'] ?? null;
        $reference = $payload['data']['reference'] ?? null;

        if ($event !== 'charge.success' || blank($reference)) {
            return response()->json(['message' => 'Event ignored']);
        }

        $payment = Payment::where('reference', $reference)->first();

        if (! $payment) {
            Log::warning('Paystack webhook payment not found', [
                'reference' => $reference,
            ]);

            return response()->json(['message' => 'Payment not found']);
        }

        $result = $this->verifyAndActivate($payment, $paystack, $activation);

        return response()->json([
            'message' => $result['message'],
            'success' => $result['success'],
        ]);
    }

    public function testActivate(Payment $payment, PaymentActivationService $activation)
    {
        if (! app()->environment('local')) {
            abort(403);
        }

        $result = $activation->activate($payment);

        return redirect()
            ->route('payment.success', $payment)
            ->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    public function success(Payment $payment)
    {
        $payment->load(['customer.router', 'plan']);

        return view('portal.payment_success', compact('payment'));
    }

    private function verifyAndActivate(Payment $payment, PaystackService $paystack, PaymentActivationService $activation): array
    {
        try {
            if ($payment->status === 'successful' && $payment->customer?->mikrotik_created) {
                return [
                    'success' => true,
                    'message' => 'Payment already activated.',
                ];
            }

            $verifyData = $paystack->verify($payment->reference);

            $payment->update([
                'payload' => array_merge($payment->payload ?? [], [
                    'paystack_verify' => $verifyData,
                ]),
            ]);

            if (($verifyData['status'] ?? null) !== 'success') {
                return [
                    'success' => false,
                    'message' => 'Payment was not successful. Current Paystack status: ' . ($verifyData['status'] ?? 'unknown'),
                ];
            }

            $expectedAmount = $paystack->expectedKobo($payment);
            $paidAmount = $paystack->paidKoboFromVerification($verifyData);

            if ($paidAmount !== $expectedAmount) {
                return [
                    'success' => false,
                    'message' => 'Payment amount mismatch. Expected ' . $expectedAmount . ' kobo but received ' . $paidAmount . ' kobo.',
                ];
            }

            return $activation->activate($payment->fresh(['customer', 'plan']));
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage(),
            ];
        }
    }
}
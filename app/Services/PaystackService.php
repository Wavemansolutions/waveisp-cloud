<?php

namespace App\Services;

use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Http;

class PaystackService
{
    private string $baseUrl = 'https://api.paystack.co';

    public function initialize(Payment $payment): array
    {
        $secret = config('services.paystack.secret_key');

        if (blank($secret)) {
            throw new Exception('Paystack secret key is not configured in .env.');
        }

        $payment->loadMissing(['customer', 'plan']);

        $customer = $payment->customer;
        $plan = $payment->plan;

        if (! $customer || ! $plan) {
            throw new Exception('Payment must have customer and plan before Paystack initialization.');
        }

        $email = $customer->email ?: $this->fallbackEmail($customer->phone);

        $response = Http::withToken($secret)
            ->acceptJson()
            ->post($this->baseUrl . '/transaction/initialize', [
                'email' => $email,
                'amount' => $this->amountToKobo($payment->amount),
                'reference' => $payment->reference,
                'currency' => config('services.paystack.currency', 'NGN'),
                'callback_url' => route('payment.callback'),
                'metadata' => [
                    'payment_id' => $payment->id,
                    'customer_id' => $customer->id,
                    'plan_id' => $plan->id,
                    'plan_name' => $plan->name,
                    'phone' => $customer->phone,
                    'voucher_password' => $customer->password,
                ],
            ]);

        if (! $response->successful()) {
            throw new Exception('Paystack initialize failed: ' . $response->body());
        }

        $json = $response->json();

        if (($json['status'] ?? false) !== true) {
            throw new Exception($json['message'] ?? 'Paystack rejected initialization.');
        }

        $payment->update([
            'payload' => array_merge($payment->payload ?? [], [
                'paystack_initialize' => $json,
            ]),
        ]);

        return $json['data'] ?? [];
    }

    public function verify(string $reference): array
    {
        $secret = config('services.paystack.secret_key');

        if (blank($secret)) {
            throw new Exception('Paystack secret key is not configured in .env.');
        }

        $response = Http::withToken($secret)
            ->acceptJson()
            ->get($this->baseUrl . '/transaction/verify/' . urlencode($reference));

        if (! $response->successful()) {
            throw new Exception('Paystack verify failed: ' . $response->body());
        }

        $json = $response->json();

        if (($json['status'] ?? false) !== true) {
            throw new Exception($json['message'] ?? 'Paystack verification failed.');
        }

        return $json['data'] ?? [];
    }

    public function expectedKobo(Payment $payment): int
    {
        return $this->amountToKobo($payment->amount);
    }

    public function paidKoboFromVerification(array $data): int
    {
        return (int) ($data['requested_amount'] ?? $data['amount'] ?? 0);
    }

    private function amountToKobo($amount): int
    {
        return (int) round(((float) $amount) * 100);
    }

    private function fallbackEmail(?string $phone): string
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone ?: 'customer');

        return $cleanPhone . '@waveisp.local';
    }
}
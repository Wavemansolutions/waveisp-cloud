<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentActivationService;

class PaymentController extends Controller
{
    public function testActivate(Payment $payment, PaymentActivationService $activation)
    {
        if (! app()->environment('local')) {
            abort(403);
        }

        $result = $activation->activate($payment);

        if ($result['success']) {
            return redirect()
                ->route('payment.success', $payment)
                ->with('success', $result['message']);
        }

        return redirect()
            ->route('payment.success', $payment)
            ->with('error', $result['message']);
    }

    public function success(Payment $payment)
    {
        $payment->load(['customer.router', 'plan']);

        return view('portal.payment_success', compact('payment'));
    }
}
<?php

namespace App\Services;

use App\Models\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentActivationService
{
    public function __construct(
        private MikrotikService $mikrotik
    ) {}

    public function activate(Payment $payment): array
    {
        try {
            $payment->loadMissing(['customer', 'plan']);

            if (! $payment->customer) {
                throw new Exception('Payment has no customer attached.');
            }

            if (! $payment->plan) {
                throw new Exception('Payment has no plan attached.');
            }

            $customer = $payment->customer;
            $plan = $payment->plan;

            $startsAt = now();
            $expiresAt = $this->calculateExpiry($startsAt, $plan->validity_value, $plan->validity_unit);

            DB::transaction(function () use ($payment, $customer, $plan, $startsAt, $expiresAt) {
                $payment->update([
                    'status' => 'successful',
                ]);

                $customer->update([
                    'plan_id' => $plan->id,
                    'status' => 'active',
                    'starts_at' => $startsAt,
                    'expires_at' => $expiresAt,
                ]);
            });

            $mikrotikResult = $this->mikrotik->createOrUpdateHotspotUser($customer->fresh(['router', 'plan']));

            $customer->fresh()->update([
                'mikrotik_created' => $mikrotikResult['success'],
                'mikrotik_created_at' => $mikrotikResult['success'] ? now() : null,
                'mikrotik_error' => $mikrotikResult['success'] ? null : $mikrotikResult['message'],
            ]);

            return [
                'success' => $mikrotikResult['success'],
                'message' => $mikrotikResult['message'],
                'payment' => $payment->fresh(['customer', 'plan']),
                'customer' => $customer->fresh(['router', 'plan']),
                'mikrotik' => $mikrotikResult,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Payment activation failed: ' . $e->getMessage(),
                'payment' => $payment,
                'customer' => $payment->customer,
                'mikrotik' => [],
            ];
        }
    }

    private function calculateExpiry(Carbon $startsAt, int $value, string $unit): Carbon
    {
        return match ($unit) {
            'hour', 'hours' => $startsAt->copy()->addHours($value),
            'day', 'days' => $startsAt->copy()->addDays($value),
            'week', 'weeks' => $startsAt->copy()->addWeeks($value),
            'month', 'months' => $startsAt->copy()->addMonths($value),
            default => $startsAt->copy()->addDays($value),
        };
    }
}
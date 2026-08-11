<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\RouterJob;
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
            $payment->loadMissing(['customer.router', 'customer.plan', 'plan']);

            if (! $payment->customer) {
                throw new Exception('Payment has no customer attached.');
            }

            if (! $payment->plan) {
                throw new Exception('Payment has no plan attached.');
            }

            $customer = $payment->customer;
            $plan = $payment->plan;

            if (! $customer->router) {
                throw new Exception('No active router assigned. Add a router in Admin → Routers first.');
            }

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

            $customer = $customer->fresh(['router', 'plan']);

            if (config('waveisp.router_sync_mode', 'agent') === 'agent') {
                $job = RouterJob::create([
                    'router_id' => $customer->router_id,
                    'customer_id' => $customer->id,
                    'job_type' => 'create_hotspot_user',
                    'status' => 'pending',
                    'payload' => [
                        'username' => $customer->username,
                        'password' => $customer->password,
                        'profile' => $plan->mikrotik_profile ?: 'WAVEISP-2M',
                        'limit_bytes_total' => (int) $plan->data_limit_mb * 1024 * 1024,
                        'mac_address' => $customer->mac_address,
                        'comment' => 'WaveISP customer #' . $customer->id . ' - ' . ($customer->phone ?? 'no phone'),
                    ],
                ]);

                $customer->update([
                    'mikrotik_created' => false,
                    'mikrotik_created_at' => null,
                    'mikrotik_error' => 'Queued for MikroTik agent. Router will activate this voucher when online.',
                ]);

                return [
                    'success' => true,
                    'message' => 'Payment successful. Voucher queued for MikroTik router agent.',
                    'payment' => $payment->fresh(['customer', 'plan']),
                    'customer' => $customer->fresh(['router', 'plan']),
                    'mikrotik' => [
                        'mode' => 'agent',
                        'job_id' => $job->id,
                    ],
                ];
            }

            $mikrotikResult = $this->mikrotik->createOrUpdateHotspotUser($customer);

            $customer->update([
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
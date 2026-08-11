<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDevice;
use App\Models\RouterJob;
use Illuminate\Http\Request;

class ConnectController extends Controller
{
    public function connect(Request $request)
    {
        $hotspot = $this->hotspotData($request);
        $mac = $this->normalizeMac($hotspot['mac']);

        if (blank($mac)) {
            return view('portal.access_required', [
                'hotspot' => $hotspot,
                'message' => 'Device MAC address was not received from MikroTik.',
            ]);
        }

        $this->saveSeenDevice($mac, $hotspot, null);

        $customer = $this->activeCustomerForMac($mac);

        if ($customer) {
            $customer->update([
                'ip_address' => $hotspot['ip'],
                'last_seen_at' => now(),
            ]);

            $this->saveSeenDevice($mac, $hotspot, $customer);
            $this->queueRouterSyncIfNeeded($customer);

            return view('portal.auto_login', [
                'customer' => $customer->fresh(['plan', 'router']),
                'hotspot' => $hotspot,
                'loginUrl' => $this->normalizeLoginUrl($hotspot['login']),
                'message' => 'Active package found for this device. Reconnecting automatically.',
            ]);
        }

        return view('portal.access_required', [
            'hotspot' => $hotspot,
            'message' => 'No active package was found for this device. Enter your voucher password or buy a plan.',
        ]);
    }

    public function validateVoucher(Request $request)
    {
        $hotspot = $this->hotspotData($request);
        $mac = $this->normalizeMac($hotspot['mac']);

        $data = $request->validate([
            'voucher_password' => ['required', 'string', 'max:80'],
        ]);

        if (blank($mac)) {
            return back()->with('error', 'Device MAC address was not received from MikroTik.');
        }

        $voucher = strtoupper(trim($data['voucher_password']));

        $customer = Customer::with(['plan', 'router'])
            ->where(function ($query) use ($voucher) {
                $query->where('password', $voucher)
                    ->orWhere('username', $voucher);
            })
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->first();

        if (! $customer) {
            return back()->with('error', 'Voucher is invalid, expired, suspended, or has no active package.');
        }

        if (! blank($customer->mac_address) && strtoupper($customer->mac_address) !== $mac) {
            return back()->with('error', 'This voucher is already attached to another device.');
        }

        $customer->update([
            'mac_address' => $mac,
            'ip_address' => $hotspot['ip'],
            'last_seen_at' => now(),
        ]);

        $customer = $customer->fresh(['plan', 'router']);

        $this->saveSeenDevice($mac, $hotspot, $customer);
        $this->queueRouterSyncIfNeeded($customer);

        return view('portal.auto_login', [
            'customer' => $customer,
            'hotspot' => $hotspot,
            'loginUrl' => $this->normalizeLoginUrl($hotspot['login']),
            'message' => 'Voucher validated. This device has been linked and will reconnect automatically while the package is active.',
        ]);
    }

    private function hotspotData(Request $request): array
    {
        return [
            'login' => $request->input('hotspot_login', $request->query('hotspot_login')),
            'mac' => $request->input('hotspot_mac', $request->query('hotspot_mac')),
            'ip' => $request->input('hotspot_ip', $request->query('hotspot_ip')),
            'dst' => $request->input('hotspot_dst', $request->query('hotspot_dst')),
        ];
    }

    private function normalizeMac(?string $mac): ?string
    {
        if (blank($mac)) {
            return null;
        }

        $mac = strtoupper(trim($mac));
        $mac = str_replace('-', ':', $mac);

        return $mac;
    }

    private function normalizeLoginUrl(?string $loginUrl): string
    {
        $loginUrl = $loginUrl ?: 'http://172.16.30.1/login';

        if (str_contains($loginUrl, 'login.mtu.com.ng')) {
            return 'http://172.16.30.1/login';
        }

        return $loginUrl;
    }

    private function activeCustomerForMac(string $mac): ?Customer
    {
        return Customer::with(['plan', 'router'])
            ->where('mac_address', $mac)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest('expires_at')
            ->first();
    }

    private function saveSeenDevice(string $mac, array $hotspot, ?Customer $customer): void
    {
        CustomerDevice::updateOrCreate(
            ['mac_address' => $mac],
            [
                'ip_address' => $hotspot['ip'],
                'customer_id' => $customer?->id,
                'router_id' => $customer?->router_id,
                'status' => $customer ? 'active' : 'seen',
                'first_seen_at' => CustomerDevice::where('mac_address', $mac)->value('first_seen_at') ?? now(),
                'last_seen_at' => now(),
                'last_user_agent' => request()->userAgent(),
            ]
        );
    }

    private function queueRouterSyncIfNeeded(Customer $customer): void
    {
        $customer->loadMissing(['plan', 'router']);

        if (! $customer->router || ! $customer->plan) {
            return;
        }

        if ($customer->mikrotik_created) {
            return;
        }

        $alreadyQueued = RouterJob::where('customer_id', $customer->id)
            ->whereIn('status', ['pending', 'processing'])
            ->exists();

        if ($alreadyQueued) {
            return;
        }

        RouterJob::create([
            'router_id' => $customer->router_id,
            'customer_id' => $customer->id,
            'job_type' => 'create_hotspot_user',
            'status' => 'pending',
            'payload' => [
                'username' => $customer->username,
                'password' => $customer->password,
                'profile' => $customer->plan->mikrotik_profile ?: 'WAVEISP-2M',
                'limit_bytes_total' => (int) $customer->plan->data_limit_mb * 1024 * 1024,
                'mac_address' => $customer->mac_address,
                'comment' => 'WaveISP reconnect sync customer #' . $customer->id,
            ],
        ]);

        $customer->update([
            'mikrotik_error' => 'Router sync queued for this device MAC address.',
        ]);
    }
}
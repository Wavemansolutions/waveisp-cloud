<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\RouterJob;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['plan', 'router'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;

                $query->where(function ($sub) use ($q) {
                    $sub->where('full_name', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('username', 'like', "%{$q}%")
                        ->orWhere('password', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['plan', 'router', 'payments' => fn ($query) => $query->latest()->limit(20)]);

        return view('admin.customers.show', compact('customer'));
    }

    public function activate(Customer $customer)
    {
        $customer->update([
            'status' => 'active',
        ]);

        return redirect()
            ->back()
            ->with('success', 'User activated successfully.');
    }

    public function suspend(Customer $customer)
    {
        $customer->update([
            'status' => 'suspended',
        ]);

        return redirect()
            ->back()
            ->with('success', 'User suspended successfully.');
    }

    public function sync(Customer $customer)
    {
        $customer->load(['router', 'plan']);

        if (! $customer->router || ! $customer->plan) {
            return redirect()
                ->back()
                ->with('error', 'User needs router and plan before sync.');
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
                'comment' => 'WaveISP manual sync customer #' . $customer->id,
            ],
        ]);

        $customer->update([
            'mikrotik_created' => false,
            'mikrotik_created_at' => null,
            'mikrotik_error' => 'Manual sync queued for MikroTik agent.',
        ]);

        return redirect()
            ->back()
            ->with('success', 'User sync job queued for MikroTik agent.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'User deleted successfully.');
    }
}
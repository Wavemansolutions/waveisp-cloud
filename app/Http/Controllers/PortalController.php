<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortalController extends Controller
{
    public function home()
    {
        $plans = Plan::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();

        return view('portal.home', compact('plans'));
    }

    public function plans()
    {
        $plans = Plan::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();

        return view('portal.plans', compact('plans'));
    }

    public function support()
    {
        return view('portal.support');
    }

    public function buy(Request $request, Plan $plan)
    {
        if (! $plan->is_active) {
            abort(404);
        }

        return view('portal.checkout', [
            'plan' => $plan,
            'hotspot' => [
                'login' => $request->query('hotspot_login'),
                'mac' => $request->query('hotspot_mac'),
                'ip' => $request->query('hotspot_ip'),
                'dst' => $request->query('hotspot_dst'),
            ],
        ]);
    }

    public function submit(Request $request, Plan $plan)
    {
        if (! $plan->is_active) {
            abort(404);
        }

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'regex:/^0[0-9]{10}$/'],
            'email' => ['nullable', 'email', 'max:160'],
            'hotspot_login' => ['nullable', 'string', 'max:2048'],
            'hotspot_mac' => ['nullable', 'string', 'max:32'],
            'hotspot_ip' => ['nullable', 'string', 'max:45'],
            'hotspot_dst' => ['nullable', 'string', 'max:2048'],
        ], [
            'phone.regex' => 'Enter a valid 11-digit phone number starting with 0, for example 08123456789.',
        ]);

        $router = Router::where('is_active', true)->first();

        $accessCode = 'WAVE-' . strtoupper(Str::random(10));

        $customer = Customer::create([
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'mac_address' => strtoupper($data['hotspot_mac'] ?? ''),
            'ip_address' => $data['hotspot_ip'] ?? null,
            'last_seen_at' => now(),
            'username' => $accessCode,
            'password' => $accessCode,
            'router_id' => $router?->id,
            'plan_id' => $plan->id,
            'status' => 'pending',
        ]);

        $payment = Payment::create([
            'customer_id' => $customer->id,
            'plan_id' => $plan->id,
            'amount' => $plan->price,
            'reference' => 'PAY-' . strtoupper(Str::random(12)),
            'provider' => 'paystack',
            'status' => 'pending',
            'hotspot_login_url' => $data['hotspot_login'] ?? null,
            'hotspot_mac' => strtoupper($data['hotspot_mac'] ?? ''),
            'hotspot_ip' => $data['hotspot_ip'] ?? null,
            'hotspot_dst' => $data['hotspot_dst'] ?? null,
            'hotspot_captured_at' => now(),
        ]);

        return view('portal.checkout_pending', [
            'plan' => $plan,
            'customer' => $customer,
            'payment' => $payment,
        ]);
    }
}
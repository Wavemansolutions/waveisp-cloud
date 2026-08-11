<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Router;
use App\Models\RouterJob;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'customers' => Customer::count(),
            'active_customers' => Customer::where('status', 'active')->count(),
            'plans' => Plan::count(),
            'active_plans' => Plan::where('is_active', true)->count(),
            'routers' => Router::count(),
            'successful_payments' => Payment::where('status', 'successful')->count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'revenue' => Payment::where('status', 'successful')->sum('amount'),
            'pending_jobs' => RouterJob::where('status', 'pending')->count(),
            'failed_jobs' => RouterJob::where('status', 'failed')->count(),
        ];

        $recentPayments = Payment::with(['customer', 'plan'])
            ->latest()
            ->limit(8)
            ->get();

        $recentCustomers = Customer::with(['plan', 'router'])
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentPayments', 'recentCustomers'));
    }
}
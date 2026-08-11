<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\RouterJob;

class StatisticsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_revenue' => Payment::where('status', 'successful')->sum('amount'),
            'today_revenue' => Payment::where('status', 'successful')->whereDate('created_at', today())->sum('amount'),
            'successful_payments' => Payment::where('status', 'successful')->count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'customers' => Customer::count(),
            'active_customers' => Customer::where('status', 'active')->count(),
            'plans' => Plan::count(),
            'router_jobs' => RouterJob::count(),
            'pending_jobs' => RouterJob::where('status', 'pending')->count(),
            'failed_jobs' => RouterJob::where('status', 'failed')->count(),
        ];

        $topPlans = Payment::select('plan_id')
            ->selectRaw('COUNT(*) as sales_count')
            ->selectRaw('SUM(amount) as revenue')
            ->where('status', 'successful')
            ->groupBy('plan_id')
            ->with('plan')
            ->orderByDesc('sales_count')
            ->limit(10)
            ->get();

        $recentJobs = RouterJob::with(['router', 'customer'])
            ->latest()
            ->limit(12)
            ->get();

        return view('admin.statistics.index', compact('stats', 'topPlans', 'recentJobs'));
    }
}
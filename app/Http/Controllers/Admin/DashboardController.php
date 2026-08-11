<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Router;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'customersCount' => Customer::count(),
            'activeCustomersCount' => Customer::where('status', 'active')->count(),
            'plansCount' => Plan::count(),
            'routersCount' => Router::count(),
            'paymentsCount' => Payment::count(),
            'successfulRevenue' => Payment::where('status', 'successful')->sum('amount'),
        ]);
    }
}

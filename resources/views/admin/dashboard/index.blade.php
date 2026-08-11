@extends('admin.layout')

@section('title', 'Dashboard - WaveISP Admin')
@section('subtitle', 'Main control center for WaveISP billing, plans, users and routers')

@section('content')
<div class="stats-grid">
    <div class="stat">
        <strong>₦{{ number_format($stats['revenue'], 0) }}</strong>
        <span>Total Successful Revenue</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['customers'] }}</strong>
        <span>Total Users / Customers</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['active_customers'] }}</strong>
        <span>Active Users</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['active_plans'] }}</strong>
        <span>Active Plans</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['successful_payments'] }}</strong>
        <span>Successful Payments</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['pending_payments'] }}</strong>
        <span>Pending Payments</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['pending_jobs'] }}</strong>
        <span>Pending Router Jobs</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['failed_jobs'] }}</strong>
        <span>Failed Router Jobs</span>
    </div>
</div>

<section class="card">
    <div class="card-head">
        <h2>Quick Admin Functions</h2>
    </div>

    <div class="card-body">
        <div class="actions">
            <a href="{{ route('admin.plans.create') }}" class="btn">+ Add Plan</a>
            <a href="{{ route('admin.plans.index') }}" class="btn btn-light">Manage Plans</a>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-light">Manage Users</a>
            <a href="{{ route('admin.routers.create') }}" class="btn btn-light">Add Router</a>
            <a href="{{ route('admin.statistics') }}" class="btn btn-light">View Statistics</a>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>Recent Payments</h2>
        <a href="{{ route('admin.statistics') }}" class="btn btn-light">View All Stats</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Customer</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentPayments as $payment)
                    <tr>
                        <td>{{ $payment->reference }}</td>
                        <td>{{ $payment->customer?->full_name ?? '-' }}</td>
                        <td>{{ $payment->plan?->name ?? '-' }}</td>
                        <td>₦{{ number_format($payment->amount, 0) }}</td>
                        <td><span class="badge {{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                        <td>{{ $payment->created_at?->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No payments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>Recent Users</h2>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-light">View Users</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Router</th>
                    <th>Joined</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentCustomers as $customer)
                    <tr>
                        <td>{{ $customer->full_name ?? '-' }}</td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td>{{ $customer->plan?->name ?? '-' }}</td>
                        <td><span class="badge {{ $customer->status }}">{{ ucfirst($customer->status) }}</span></td>
                        <td>{{ $customer->router?->name ?? '-' }}</td>
                        <td>{{ $customer->created_at?->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
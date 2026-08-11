@extends('admin.layout')

@section('title', 'Statistics - WaveISP Admin')
@section('subtitle', 'Revenue, user, payment and router job statistics')

@section('content')
<div class="stats-grid">
    <div class="stat">
        <strong>₦{{ number_format($stats['total_revenue'], 0) }}</strong>
        <span>Total Revenue</span>
    </div>

    <div class="stat">
        <strong>₦{{ number_format($stats['today_revenue'], 0) }}</strong>
        <span>Today Revenue</span>
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
        <strong>{{ $stats['customers'] }}</strong>
        <span>Total Users</span>
    </div>

    <div class="stat">
        <strong>{{ $stats['active_customers'] }}</strong>
        <span>Active Users</span>
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
        <h2>Top Selling Plans</h2>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Plan</th>
                    <th>Sales</th>
                    <th>Revenue</th>
                </tr>
            </thead>

            <tbody>
                @forelse($topPlans as $item)
                    <tr>
                        <td>{{ $item->plan?->name ?? 'Deleted Plan' }}</td>
                        <td>{{ $item->sales_count }}</td>
                        <td>₦{{ number_format($item->revenue, 0) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No successful plan sales yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>Recent Router Jobs</h2>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Router</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Attempts</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentJobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->router?->name ?? '-' }}</td>
                        <td>{{ $job->customer?->full_name ?? '-' }}</td>
                        <td>{{ $job->job_type }}</td>
                        <td><span class="badge {{ $job->status }}">{{ ucfirst($job->status) }}</span></td>
                        <td>{{ $job->attempts }}</td>
                        <td>{{ $job->created_at?->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No router jobs yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
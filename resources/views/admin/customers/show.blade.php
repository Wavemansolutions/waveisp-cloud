@extends('admin.layout')

@section('title', 'User Details - WaveISP Admin')
@section('subtitle', 'Customer voucher, payment and router information')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>{{ $customer->full_name ?? 'User Details' }}</h2>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-light">Back to Users</a>
    </div>

    <div class="card-body">
        <div class="stats-grid">
            <div class="stat">
                <strong>{{ $customer->password ?? '-' }}</strong>
                <span>Voucher Password</span>
            </div>

            <div class="stat">
                <strong>{{ $customer->plan?->name ?? '-' }}</strong>
                <span>Current Plan</span>
            </div>

            <div class="stat">
                <strong>{{ ucfirst($customer->status) }}</strong>
                <span>User Status</span>
            </div>

            <div class="stat">
                <strong>{{ $customer->mikrotik_created ? 'Created' : 'Not Created' }}</strong>
                <span>MikroTik Status</span>
            </div>
        </div>

        <div class="actions">
            <form method="POST" action="{{ route('admin.customers.sync', $customer) }}">
                @csrf
                <button type="submit" class="btn btn-orange">Queue Router Sync</button>
            </form>

            <form method="POST" action="{{ route('admin.customers.activate', $customer) }}">
                @csrf
                <button type="submit" class="btn btn-green">Activate</button>
            </form>

            <form method="POST" action="{{ route('admin.customers.suspend', $customer) }}">
                @csrf
                <button type="submit" class="btn btn-red">Suspend</button>
            </form>
        </div>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>User Information</h2>
    </div>

    <div class="table-wrap">
        <table>
            <tr><th>Name</th><td>{{ $customer->full_name ?? '-' }}</td></tr>
            <tr><th>Phone</th><td>{{ $customer->phone ?? '-' }}</td></tr>
            <tr><th>Email</th><td>{{ $customer->email ?? '-' }}</td></tr>
            <tr><th>MAC Address</th><td>{{ $customer->mac_address ?? '-' }}</td></tr>
            <tr><th>IP Address</th><td>{{ $customer->ip_address ?? '-' }}</td></tr>
            <tr><th>Router</th><td>{{ $customer->router?->name ?? '-' }}</td></tr>
            <tr><th>Starts At</th><td>{{ $customer->starts_at?->format('d M Y, h:i A') ?? '-' }}</td></tr>
            <tr><th>Expires At</th><td>{{ $customer->expires_at?->format('d M Y, h:i A') ?? '-' }}</td></tr>
            <tr><th>MikroTik Error</th><td>{{ $customer->mikrotik_error ?? '-' }}</td></tr>
        </table>
    </div>
</section>

<section class="card">
    <div class="card-head">
        <h2>Recent Payments</h2>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Provider</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customer->payments as $payment)
                    <tr>
                        <td>{{ $payment->reference }}</td>
                        <td>₦{{ number_format($payment->amount, 0) }}</td>
                        <td><span class="badge {{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                        <td>{{ $payment->provider }}</td>
                        <td>{{ $payment->created_at?->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No payments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
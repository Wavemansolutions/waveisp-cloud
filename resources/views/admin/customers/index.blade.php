@extends('admin.layout')

@section('title', 'Users - WaveISP Admin')
@section('subtitle', 'Manage customers, vouchers, status and router sync')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>Users / Customers</h2>
    </div>

    <div class="card-body">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="form-grid">
            <div class="field">
                <label>Search</label>
                <input name="q" value="{{ request('q') }}" placeholder="Name, phone, email or voucher">
            </div>

            <div class="field">
                <label>Status</label>
                <select name="status">
                    <option value="">All Status</option>
                    @foreach(['pending', 'active', 'suspended', 'expired'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>&nbsp;</label>
                <button class="btn" type="submit">Filter Users</button>
            </div>
        </form>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Voucher</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th>Router</th>
                    <th>MikroTik</th>
                    <th>Expires</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>
                            <strong>{{ $customer->full_name ?? '-' }}</strong><br>
                            <small>{{ $customer->email ?? '' }}</small>
                        </td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td>{{ $customer->password ?? '-' }}</td>
                        <td>{{ $customer->plan?->name ?? '-' }}</td>
                        <td><span class="badge {{ $customer->status }}">{{ ucfirst($customer->status) }}</span></td>
                        <td>{{ $customer->router?->name ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $customer->mikrotik_created ? 'completed' : 'pending' }}">
                                {{ $customer->mikrotik_created ? 'Created' : 'Not Created' }}
                            </span>
                        </td>
                        <td>{{ $customer->expires_at?->format('d M Y, h:i A') ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-gray">View</a>

                                <form method="POST" action="{{ route('admin.customers.sync', $customer) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-orange">Sync</button>
                                </form>

                                @if($customer->status === 'active')
                                    <form method="POST" action="{{ route('admin.customers.suspend', $customer) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-red">Suspend</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.customers.activate', $customer) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-green">Activate</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.customers.destroy', $customer) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-red">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-body">
        {{ $customers->links() }}
    </div>
</section>
@endsection
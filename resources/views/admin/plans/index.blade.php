@extends('admin.layout')

@section('title', 'Plans - WaveISP Admin')
@section('subtitle', 'Add, edit, pause or delete internet plans')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>Internet Plans</h2>
        <a href="{{ route('admin.plans.create') }}" class="btn">+ Add Plan</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Plan</th>
                    <th>Price</th>
                    <th>Data</th>
                    <th>Validity</th>
                    <th>Speed</th>
                    <th>MikroTik Profile</th>
                    <th>Status</th>
                    <th>Sort</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($plans as $plan)
                    @php
                        $dataLabel = $plan->data_limit_mb >= 1024
                            ? rtrim(rtrim(number_format($plan->data_limit_mb / 1024, 2), '0'), '.') . 'GB'
                            : $plan->data_limit_mb . 'MB';
                    @endphp

                    <tr>
                        <td><strong>{{ $plan->name }}</strong></td>
                        <td>₦{{ number_format($plan->price, 0) }}</td>
                        <td>{{ $dataLabel }}</td>
                        <td>{{ $plan->validity_value }} {{ ucfirst($plan->validity_unit) }}</td>
                        <td>{{ $plan->speed_limit ?? '-' }}</td>
                        <td>{{ $plan->mikrotik_profile }}</td>
                        <td>
                            <span class="badge {{ $plan->is_active ? 'active' : 'inactive' }}">
                                {{ $plan->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $plan->sort_order }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-gray">Edit</a>

                                <form method="POST" action="{{ route('admin.plans.toggle', $plan) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-orange">
                                        {{ $plan->is_active ? 'Pause' : 'Activate' }}
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('admin.plans.destroy', $plan) }}" onsubmit="return confirm('Delete this plan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-red">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No plans yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
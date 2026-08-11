@extends('admin.layout')

@section('title', 'Edit Plan - WaveISP Admin')
@section('subtitle', 'Update an existing data plan')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>Edit Plan: {{ $plan->name }}</h2>
        <a href="{{ route('admin.plans.index') }}" class="btn btn-light">Back</a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.plans.update', $plan) }}">
            @csrf
            @method('PUT')

            @include('admin.plans.partials.form', ['plan' => $plan])

            <button type="submit" class="btn">Update Plan</button>
        </form>
    </div>
</section>
@endsection
@extends('admin.layout')

@section('title', 'Add Plan - WaveISP Admin')
@section('subtitle', 'Create a new data plan')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>Add Internet Plan</h2>
        <a href="{{ route('admin.plans.index') }}" class="btn btn-light">Back</a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.plans.store') }}">
            @csrf

            @include('admin.plans.partials.form', ['plan' => null])

            <button type="submit" class="btn">Save Plan</button>
        </form>
    </div>
</section>
@endsection
@extends('admin.layout')

@section('title', 'Settings & Branding - WaveISP Admin')
@section('subtitle', 'Customize brand identity, colors, support page, home page and footer text')

@section('content')
<section class="card">
    <div class="card-head">
        <h2>Settings & Branding</h2>
        <a href="{{ route('portal.home') }}" class="btn btn-light">Preview Website</a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf

            @foreach($groups as $groupName => $items)
                <section class="card" style="box-shadow:none;">
                    <div class="card-head">
                        <h2>{{ ucwords(str_replace('_', ' ', $groupName)) }}</h2>
                    </div>

                    <div class="card-body">
                        <div class="form-grid">
                            @foreach($items as $item)
                                <div class="field" style="{{ $item['type'] === 'textarea' ? 'grid-column:1 / -1;' : '' }}">
                                    <label>{{ ucwords(str_replace('_', ' ', $item['key'])) }}</label>

                                    @if($item['type'] === 'textarea')
                                        <textarea
                                            name="{{ $item['key'] }}"
                                            rows="4"
                                            style="width:100%;border:1px solid #cbd5e1;border-radius:12px;padding:14px;font-size:15px;font-family:inherit;background:#fbfdff;"
                                        >{{ old($item['key'], $item['value']) }}</textarea>
                                    @else
                                        <input
                                            type="{{ $item['type'] }}"
                                            name="{{ $item['key'] }}"
                                            value="{{ old($item['key'], $item['value']) }}"
                                        >
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach

            <button type="submit" class="btn">
                Save Settings & Branding
            </button>
        </form>
    </div>
</section>
@endsection
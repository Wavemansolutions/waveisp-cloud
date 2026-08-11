@php
    $plan = $plan ?? null;
@endphp

<div class="form-grid">
    <div class="field">
        <label>Plan Name</label>
        <input name="name" value="{{ old('name', $plan?->name) }}" placeholder="Daily 1GB" required>
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Price ₦</label>
        <input name="price" type="number" step="0.01" value="{{ old('price', $plan?->price) }}" placeholder="300" required>
        @error('price') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Data Limit MB</label>
        <input name="data_limit_mb" type="number" value="{{ old('data_limit_mb', $plan?->data_limit_mb) }}" placeholder="1024" required>
        @error('data_limit_mb') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Validity Value</label>
        <input name="validity_value" type="number" value="{{ old('validity_value', $plan?->validity_value ?? 1) }}" required>
        @error('validity_value') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Validity Unit</label>
        <select name="validity_unit" required>
            @foreach(['hours', 'days', 'weeks', 'months'] as $unit)
                <option value="{{ $unit }}" @selected(old('validity_unit', $plan?->validity_unit ?? 'days') === $unit)>
                    {{ ucfirst($unit) }}
                </option>
            @endforeach
        </select>
        @error('validity_unit') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>MikroTik Profile</label>
        <input name="mikrotik_profile" value="{{ old('mikrotik_profile', $plan?->mikrotik_profile ?? 'WAVEISP-2M') }}" required>
        @error('mikrotik_profile') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Speed Limit</label>
        <input name="speed_limit" value="{{ old('speed_limit', $plan?->speed_limit ?? '2M/2M') }}" placeholder="2M/2M">
        @error('speed_limit') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Sort Order</label>
        <input name="sort_order" type="number" value="{{ old('sort_order', $plan?->sort_order ?? 0) }}">
        @error('sort_order') <div class="error-text">{{ $message }}</div> @enderror
    </div>
</div>

<div class="field">
    <label>
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $plan?->is_active ?? true) ? 'checked' : '' }} style="width:auto;height:auto;">
        Active Plan
    </label>
</div>
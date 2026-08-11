<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - WaveISP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;font-family:Arial;background:#f4f7fb;color:#06143d;padding:24px;">

<div style="max-width:900px;margin:0 auto;">
    <a href="{{ route('portal.home') }}#plans" style="color:#0b63f6;font-weight:bold;text-decoration:none;">
        ← Back to Plans
    </a>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:24px;">
        <div style="background:white;border-radius:20px;padding:28px;box-shadow:0 12px 30px rgba(0,0,0,.08);">
            <h1>{{ $plan->name }}</h1>
            <h2 style="font-size:42px;color:#0b63f6;">₦{{ number_format($plan->price, 0) }}</h2>
            <p><strong>Data:</strong> {{ $plan->data_label }}</p>
            <p><strong>Validity:</strong> {{ (int) $plan->validity_value === 1 ? '24 Hours' : $plan->validity_value . ' ' . ucfirst($plan->validity_unit) }}</p>
            <p><strong>Speed:</strong> {{ $plan->speed_limit ?? 'Best Effort' }}</p>
        </div>

        <div style="background:white;border-radius:20px;padding:28px;box-shadow:0 12px 30px rgba(0,0,0,.08);">
            <h2>Customer Details</h2>

            <form method="POST" action="{{ route('portal.buy.submit', $plan) }}">
                @csrf

                <input type="hidden" name="hotspot_login" value="{{ $hotspot['login'] ?? '' }}">
                <input type="hidden" name="hotspot_mac" value="{{ $hotspot['mac'] ?? '' }}">
                <input type="hidden" name="hotspot_ip" value="{{ $hotspot['ip'] ?? '' }}">
                <input type="hidden" name="hotspot_dst" value="{{ $hotspot['dst'] ?? '' }}">

                <label>Full Name</label>
                <input name="full_name" value="{{ old('full_name') }}" required style="width:100%;height:48px;margin:8px 0 14px;padding:0 12px;border:1px solid #ccd6ea;border-radius:10px;">

                @error('full_name')
                    <div style="color:red;font-size:13px;">{{ $message }}</div>
                @enderror

                <label>Phone Number</label>
                <input name="phone" value="{{ old('phone') }}" required maxlength="11" placeholder="08123456789" oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,11)" style="width:100%;height:48px;margin:8px 0 14px;padding:0 12px;border:1px solid #ccd6ea;border-radius:10px;">

                @error('phone')
                    <div style="color:red;font-size:13px;">{{ $message }}</div>
                @enderror

                <label>Email Optional</label>
                <input name="email" type="email" value="{{ old('email') }}" style="width:100%;height:48px;margin:8px 0 14px;padding:0 12px;border:1px solid #ccd6ea;border-radius:10px;">

                @error('email')
                    <div style="color:red;font-size:13px;">{{ $message }}</div>
                @enderror

                <button type="submit" style="width:100%;height:52px;background:#0b63f6;color:white;border:0;border-radius:12px;font-weight:bold;font-size:16px;">
                    Proceed to Payment
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
@php
    $s = $siteSettings ?? [];
    $brand = $s['brand_name'] ?? 'WaveISP';
    $tagline = $s['brand_tagline'] ?? 'Cloud HotSpot Billing';
    $primary = $s['primary_color'] ?? '#0b63f6';
    $dark = $s['dark_color'] ?? '#061b51';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connect Device - {{ $brand }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            background: #f4f7fb;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #06143d;
            padding: 24px;
        }

        .wrap {
            max-width: 560px;
            margin: 45px auto;
        }

        .card {
            background: white;
            border-radius: 26px;
            padding: 34px;
            box-shadow: 0 18px 42px rgba(4,33,91,.13);
            border: 1px solid #dfe7f5;
        }

        .logo {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            background: {{ $primary }};
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            font-size: 28px;
            margin-bottom: 18px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 31px;
        }

        p {
            color: #475569;
            line-height: 1.6;
            font-weight: 650;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin: 16px 0;
            font-weight: 850;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .info {
            background: #eff6ff;
            color: #1e3a8a;
        }

        label {
            display: block;
            font-weight: 900;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            height: 54px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 0 15px;
            font-size: 17px;
            box-sizing: border-box;
            text-transform: uppercase;
        }

        button,
        .btn {
            width: 100%;
            height: 54px;
            border: 0;
            border-radius: 14px;
            background: {{ $primary }};
            color: white;
            font-size: 16px;
            font-weight: 950;
            cursor: pointer;
            margin-top: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-light {
            background: #eaf3ff;
            color: {{ $primary }};
        }

        .meta {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px;
            margin: 18px 0;
            color: #475569;
            font-size: 14px;
            font-weight: 750;
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="card">
        <div class="logo">{{ substr($brand, 0, 1) }}</div>

        <h1>Connect Your Device</h1>
        <p>{{ $tagline }}</p>

        <div class="alert info">
            {{ $message ?? 'Enter your voucher password to link this device.' }}
        </div>

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        <div class="meta">
            Device MAC: <strong>{{ $hotspot['mac'] ?? '-' }}</strong><br>
            Device IP: <strong>{{ $hotspot['ip'] ?? '-' }}</strong>
        </div>

        <form method="POST" action="{{ route('portal.connect.validate') }}">
            @csrf

            <input type="hidden" name="hotspot_login" value="{{ $hotspot['login'] ?? '' }}">
            <input type="hidden" name="hotspot_mac" value="{{ $hotspot['mac'] ?? '' }}">
            <input type="hidden" name="hotspot_ip" value="{{ $hotspot['ip'] ?? '' }}">
            <input type="hidden" name="hotspot_dst" value="{{ $hotspot['dst'] ?? '' }}">

            <label>Voucher Password</label>
            <input name="voucher_password" placeholder="WAVE-XXXXXXXXXX" required>

            <button type="submit">Validate & Connect</button>
        </form>

        <a href="{{ route('portal.plans') }}" class="btn btn-light">Buy Data Plan</a>
    </div>
</div>

</body>
</html>
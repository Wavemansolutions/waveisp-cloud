@php
    $s = $siteSettings ?? [];
    $brand = $s['brand_name'] ?? 'WaveISP';
    $primary = $s['primary_color'] ?? '#0b63f6';
    $dark = $s['dark_color'] ?? '#061b51';
    $dst = $hotspot['dst'] ?? 'http://neverssl.com';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connecting - {{ $brand }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, {{ $dark }}, {{ $primary }});
            font-family: "Segoe UI", Arial, sans-serif;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 26px;
            padding: 34px;
            text-align: center;
            box-shadow: 0 18px 44px rgba(0,0,0,.25);
        }

        h1 {
            margin: 0 0 10px;
            font-size: 32px;
        }

        p {
            color: #dbe8ff;
            line-height: 1.6;
            font-weight: 650;
        }

        .voucher {
            background: white;
            color: {{ $dark }};
            border-radius: 18px;
            padding: 18px;
            margin: 20px 0;
        }

        .voucher small {
            color: #64748b;
            font-weight: 800;
        }

        .voucher strong {
            display: block;
            font-size: 27px;
            letter-spacing: 1px;
            margin-top: 6px;
        }

        button {
            width: 100%;
            height: 54px;
            border: 0;
            border-radius: 14px;
            background: #ffd04f;
            color: #06143d;
            font-size: 16px;
            font-weight: 950;
            cursor: pointer;
        }

        .small {
            font-size: 13px;
            color: #bfdbfe;
            margin-top: 16px;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Connecting...</h1>

    <p>{{ $message ?? 'Your active package is valid. We are reconnecting your device.' }}</p>

    <div class="voucher">
        <small>Voucher Password</small>
        <strong>{{ $customer->password }}</strong>
    </div>

    <form id="loginForm" method="POST" action="{{ $loginUrl }}">
        <input type="hidden" name="username" value="{{ $customer->username }}">
        <input type="hidden" name="password" value="{{ $customer->password }}">
        <input type="hidden" name="dst" value="{{ $dst }}">
        <input type="hidden" name="popup" value="false">

        <button type="submit">Connect Now</button>
    </form>

    <div class="small">
        If connection does not continue automatically, tap Connect Now.
    </div>
</div>

<script>
    setTimeout(function () {
        document.getElementById('loginForm').submit();
    }, 1400);
</script>

</body>
</html>
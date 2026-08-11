@php
    $s = $siteSettings ?? [];

    $brand = $s['brand_name'] ?? 'WaveISP';
    $tagline = $s['brand_tagline'] ?? 'Connect. Surf. Live.';
    $logoText = $s['logo_text'] ?? 'W';
    $primary = $s['primary_color'] ?? '#0b63f6';
    $accent = $s['accent_color'] ?? '#ffd04f';
    $dark = $s['dark_color'] ?? '#061b51';
    $phone = $s['support_phone'] ?? '+234 813 696 3037';
    $whatsapp = preg_replace('/[^0-9]/', '', $s['support_whatsapp'] ?? '2348136963037');
    $location = $s['business_location'] ?? 'Port Harcourt, Rivers State';
    $footerText = $s['footer_text'] ?? 'Cloud HotSpot billing for MikroTik routers.';
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $s['support_title'] ?? 'Support' }} - {{ $brand }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ $s['favicon_url'] ?? '/favicon.svg' }}">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f6f9ff;
            color: #06143d;
        }

        a { text-decoration: none; }

        .top-shell {
            padding: 18px 24px 42px;
            background:
                radial-gradient(circle at 70% 20%, color-mix(in srgb, {{ $primary }} 22%, transparent), transparent 28%),
                linear-gradient(90deg, #ffffff 0%, #edf5ff 44%, {{ $primary }} 100%);
        }

        .navbar {
            max-width: 1480px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(4, 33, 91, 0.18);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 72px;
            min-height: 68px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #06143d;
        }

        .logo {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: {{ $primary }};
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: 900;
        }

        .brand-text strong {
            display: block;
            color: {{ $primary }};
            font-size: 31px;
            line-height: 1;
            letter-spacing: -1px;
        }

        .brand-text small {
            display: block;
            color: #7c879d;
            font-size: 14px;
            margin-top: 3px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 56px;
            font-size: 15px;
            font-weight: 700;
        }

        .nav-links a {
            color: #071743;
            padding: 11px 0;
        }

        .nav-links a.active {
            color: {{ $primary }};
            border-bottom: 3px solid {{ $primary }};
        }

        .connect-btn {
            background: {{ $primary }};
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 800;
            box-shadow: 0 9px 20px rgba(11, 99, 246, 0.25);
        }

        .page-title {
            max-width: 1280px;
            margin: 48px auto 0;
            padding: 0 24px;
            text-align: center;
        }

        .page-title h1 {
            margin: 0;
            font-size: 46px;
            line-height: 1.1;
            font-weight: 950;
        }

        .page-title h1 span { color: {{ $primary }}; }

        .page-title p {
            color: #263b69;
            font-size: 17px;
            font-weight: 600;
            margin-top: 14px;
        }

        .support-wrap {
            max-width: 1280px;
            margin: -18px auto 0;
            padding: 0 24px 42px;
        }

        .support-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .support-card {
            background: white;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 12px 28px rgba(5, 35, 93, 0.12);
            border: 1px solid #dde7f8;
            min-height: 240px;
        }

        .support-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #eaf3ff;
            color: {{ $primary }};
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 18px;
        }

        .support-card h3 {
            margin: 0 0 10px;
            font-size: 23px;
            color: #06143d;
        }

        .support-card p {
            color: #344465;
            line-height: 1.6;
            font-weight: 600;
        }

        .support-btn {
            display: inline-flex;
            margin-top: 12px;
            background: {{ $primary }};
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 850;
        }

        .green { background: #20bb69; }
        .purple { background: #642de9; }

        .faq-box {
            margin-top: 34px;
            background: white;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 12px 28px rgba(5, 35, 93, 0.12);
        }

        .faq-box h2 {
            margin-top: 0;
            font-size: 28px;
        }

        .faq-item {
            padding: 18px 0;
            border-bottom: 1px solid #dfe7f5;
        }

        .faq-item:last-child { border-bottom: 0; }

        .faq-item strong {
            display: block;
            color: #06143d;
            margin-bottom: 6px;
        }

        .faq-item span {
            color: #344465;
            font-weight: 600;
        }

        .footer {
            background: {{ $dark }};
            color: white;
            padding: 34px 24px;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.2fr .8fr 1fr;
            gap: 24px;
        }

        .footer a,
        .footer p {
            color: #dbe8ff;
            font-size: 14px;
            line-height: 1.7;
        }

        .footer strong span { color: {{ $accent }}; }

        @@media (max-width: 1100px) {
            .navbar { padding: 13px 24px; }
            .nav-links { gap: 22px; }
            .support-grid, .footer-inner { grid-template-columns: 1fr; }
        }

        @@media (max-width: 760px) {
            .navbar {
                flex-direction: column;
                gap: 16px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .page-title h1 { font-size: 36px; }
        }
    </style>
</head>
<body>

<div class="top-shell">
    <nav class="navbar">
        <a href="{{ route('portal.home') }}" class="brand">
            <div class="logo">{{ $logoText }}</div>
            <div class="brand-text">
                <strong>{{ $brand }}</strong>
                <small>{{ $tagline }}</small>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}">Plans</a>
            <a href="{{ route('portal.support') }}" class="active">Support</a>
            <a href="/admin/login">Login</a>
        </div>

        <a href="{{ route('portal.plans') }}" class="connect-btn">
            ⚡ Get Connected
        </a>
    </nav>

    <div class="page-title">
        <h1>
            <span>{{ $s['support_title'] ?? 'Need Support?' }}</span>
        </h1>

        <p>
            {{ $s['support_subtitle'] ?? 'Get help with payment, connection, expired plan, or data exhaustion.' }}
        </p>
    </div>
</div>

<section class="support-wrap">
    <div class="support-grid">
        <div class="support-card">
            <div class="support-icon">💬</div>
            <h3>{{ $s['support_whatsapp_title'] ?? 'WhatsApp Support' }}</h3>
            <p>{{ $s['support_whatsapp_text'] ?? 'Chat with support for quick help.' }}</p>
            <a href="https://wa.me/{{ $whatsapp }}" class="support-btn green">
                Chat on WhatsApp
            </a>
        </div>

        <div class="support-card">
            <div class="support-icon">📞</div>
            <h3>{{ $s['support_call_title'] ?? 'Call Support' }}</h3>
            <p>{{ $s['support_call_text'] ?? 'Speak directly with support.' }}</p>
            <a href="tel:{{ $phone }}" class="support-btn">
                {{ $phone }}
            </a>
        </div>

        <div class="support-card">
            <div class="support-icon">📶</div>
            <h3>{{ $s['support_connection_title'] ?? 'Connection Help' }}</h3>
            <p>{{ $s['support_connection_text'] ?? 'Restart Wi-Fi and reconnect to the hotspot.' }}</p>
            <a href="{{ route('portal.plans') }}" class="support-btn purple">
                View Plans
            </a>
        </div>
    </div>

    <div class="faq-box">
        <h2>Frequently Asked Questions</h2>

        @for($i = 1; $i <= 4; $i++)
            <div class="faq-item">
                <strong>{{ $s["faq_{$i}_question"] ?? '' }}</strong>
                <span>{{ $s["faq_{$i}_answer"] ?? '' }}</span>
            </div>
        @endfor
    </div>
</section>

<footer class="footer">
    <div class="footer-inner">
        <div>
            <strong>{{ $brand }}<span>.</span></strong>
            <p>{{ $footerText }}</p>
        </div>

        <div>
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}">Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
        </div>

        <div>
            <p>📞 {{ $phone }}</p>
            <p>📍 {{ $location }}</p>
            <p>© 2026 {{ $brand }}. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internet Plans - WaveISP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f6f9ff;
            color: #06143d;
        }

        a {
            text-decoration: none;
        }

        .top-shell {
            padding: 18px 24px 42px;
            background:
                radial-gradient(circle at 70% 20%, rgba(38, 108, 255, 0.20), transparent 28%),
                linear-gradient(90deg, #ffffff 0%, #edf5ff 44%, #0a62ee 100%);
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
        }

        .logo {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: 900;
        }

        .brand-text strong {
            display: block;
            color: #0b63f6;
            font-size: 31px;
            line-height: 1;
            letter-spacing: -1px;
        }

        .brand-text strong span {
            color: #06143d;
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
            color: #0b63f6;
            border-bottom: 3px solid #0b63f6;
        }

        .connect-btn {
            background: #0b63f6;
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

        .page-title h1 span {
            color: #0b63f6;
        }

        .page-title p {
            color: #263b69;
            font-size: 17px;
            font-weight: 600;
            margin-top: 14px;
        }

        .separator-lines {
            display: flex;
            justify-content: center;
            gap: 18px;
            margin-top: 24px;
        }

        .separator-line {
            height: 5px;
            width: 140px;
            border-radius: 999px;
            background: linear-gradient(90deg, #0b63f6, #59a3ff);
            box-shadow: 0 6px 14px rgba(11, 99, 246, 0.22);
        }

        .separator-line.small {
            width: 90px;
            background: linear-gradient(90deg, #6fb2ff, #0b63f6);
        }

        .plans-section {
            max-width: 1280px;
            margin: -18px auto 0;
            padding: 0 24px 42px;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 36px;
            align-items: stretch;
        }

        .plan-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(5, 35, 93, 0.12);
            border: 1px solid #dde7f8;
            padding: 36px 26px 18px;
            position: relative;
            overflow: hidden;
            min-height: 230px;
        }

        .plan-card::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 22px;
            background: linear-gradient(90deg, #0b63f6, #2b7dff);
        }

        .plan-card.popular {
            border: 2px solid #2d7dff;
            box-shadow: 0 16px 32px rgba(11, 99, 246, 0.20);
        }

        .plan-card.purple::before {
            background: linear-gradient(90deg, #682ce8, #823cff);
        }

        .badge {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: #246eff;
            color: white;
            height: 22px;
            padding: 2px 35px;
            border-radius: 0 0 12px 12px;
            font-size: 13px;
            font-weight: 800;
            z-index: 2;
            white-space: nowrap;
        }

        .plan-icon {
            width: 53px;
            height: 53px;
            border-radius: 50%;
            background: white;
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            box-shadow: 0 8px 18px rgba(7, 37, 84, 0.16);
            position: absolute;
            top: 25px;
            left: 36px;
        }

        .plan-card h3 {
            margin: 0 0 0 92px;
            color: #0b63f6;
            font-size: 23px;
            font-weight: 900;
        }

        .plan-card.purple h3 {
            color: #612ee9;
        }

        .price {
            margin: 4px 0 8px 92px;
            font-size: 35px;
            font-weight: 950;
            color: #071743;
            letter-spacing: 1px;
        }

        .plan-line {
            height: 2px;
            background: #d9dfeb;
            margin: 8px 0 10px;
        }

        .features {
            list-style: none;
            padding: 0 0 0 20px;
            margin: 0;
            color: #17264d;
            font-size: 15px;
            font-weight: 650;
            line-height: 1.85;
        }

        .features li {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mini {
            width: 18px;
            display: inline-flex;
            justify-content: center;
        }

        .buy-now {
            margin-top: 10px;
            height: 38px;
            border-radius: 7px;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            font-weight: 850;
        }

        .purple .buy-now {
            background: #642de9;
        }

        .footer {
            background: #061b51;
            color: white;
            padding: 24px;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .footer a,
        .footer p {
            color: #dbe8ff;
            font-size: 13px;
        }

        @media (max-width: 1100px) {
            .navbar {
                padding: 13px 24px;
            }

            .nav-links {
                gap: 22px;
            }

            .plans-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .navbar {
                flex-direction: column;
                gap: 16px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .page-title h1 {
                font-size: 36px;
            }
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body>

<div class="top-shell">
    <nav class="navbar">
        <a href="{{ route('portal.home') }}" class="brand">
            <div class="logo">W</div>
            <div class="brand-text">
                <strong>Wave<span>ISP</span></strong>
                <small>Connect. Surf. Live.</small>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}" class="active">Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
            <a href="/admin/login">Login</a>
        </div>

        <a href="{{ route('portal.plans') }}" class="connect-btn">
            ⚡ Get Connected
        </a>
    </nav>

    <div class="page-title">
        <h1>
            Choose the <span>Perfect Plan</span> for You
        </h1>

        <p>
            Select a data package, pay securely, and get connected instantly.
        </p>

        <div class="separator-lines">
            <div class="separator-line"></div>
            <div class="separator-line small"></div>
        </div>
    </div>
</div>

<section class="plans-section">
    <div class="plans-grid">
        @forelse($plans as $plan)
            @php
                $name = strtolower($plan->name);
                $isPopular = str_contains($name, 'weekly 5gb') || str_contains($name, 'weekly 10gb');
                $isPurple = str_contains($name, 'monthly');
                $icon = str_contains($name, 'monthly') ? '👑' : (str_contains($name, 'weekly') ? '📅' : '🗓️');
                $validity = ((int) $plan->validity_value === 1)
                    ? '24 Hours'
                    : $plan->validity_value . ' ' . ucfirst($plan->validity_unit);
                $speed = $plan->speed_limit ?: 'Best Effort';
                $data = $plan->data_label ?? ($plan->data_limit_mb . 'MB');
            @endphp

            <div class="plan-card {{ $isPopular ? 'popular' : '' }} {{ $isPurple ? 'purple' : '' }}">
                @if($isPopular)
                    <div class="badge">★ Most Popular</div>
                @endif

                <div class="plan-icon">{{ $icon }}</div>

                <h3>{{ $plan->name }}</h3>

                <div class="price">₦{{ number_format($plan->price, 0) }}</div>

                <div class="plan-line"></div>

                <ul class="features">
                    <li><span class="mini">🕒</span> Validity: {{ $validity }}</li>
                    <li><span class="mini">⚡</span> Speed: {{ $speed }}</li>
                    <li><span class="mini">💽</span> Data: {{ $data }}</li>
                </ul>

                <a href="{{ route('portal.buy', $plan) }}" class="buy-now">
                    Buy Now →
                </a>
            </div>
        @empty
            <div class="plan-card">
                <div class="plan-icon">📶</div>
                <h3>No Plans Yet</h3>
                <div class="price">₦0</div>
                <div class="plan-line"></div>
                <ul class="features">
                    <li><span class="mini">🕒</span> Run seeder</li>
                    <li><span class="mini">⚡</span> Add plans</li>
                    <li><span class="mini">💽</span> Refresh page</li>
                </ul>
                <a href="/admin/login" class="buy-now">Admin Login →</a>
            </div>
        @endforelse
    </div>
</section>

<footer class="footer">
    <div class="footer-inner">
        <div>
            <strong>WaveISP</strong>
            <p>Connect. Surf. Live.</p>
        </div>

        <div>
            <a href="{{ route('portal.home') }}">Home</a> |
            <a href="{{ route('portal.plans') }}">Plans</a> |
            <a href="{{ route('portal.support') }}">Support</a>
        </div>

        <div>
            <p>© 2026 WaveISP. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Internet Plan - WaveISP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                radial-gradient(circle at 80% 10%, rgba(11, 99, 246, 0.18), transparent 25%),
                linear-gradient(135deg, #f6f9ff, #eef5ff);
            color: #06143d;
            min-height: 100vh;
        }

        a { text-decoration: none; }

        .topbar {
            background: white;
            border-bottom: 1px solid #dfe7f5;
            padding: 16px 24px;
            box-shadow: 0 8px 24px rgba(4, 33, 91, 0.06);
        }

        .topbar-inner {
            max-width: 1180px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #06143d;
            font-weight: 950;
            font-size: 24px;
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            box-shadow: 0 10px 22px rgba(11, 99, 246, .22);
        }

        .brand span {
            color: #0b63f6;
        }

        .nav-links {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #0b63f6;
            font-weight: 850;
            background: #eaf3ff;
            padding: 10px 14px;
            border-radius: 10px;
        }

        .wrap {
            max-width: 1180px;
            margin: 36px auto;
            padding: 0 24px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: .92fr 1.08fr;
            gap: 28px;
            align-items: stretch;
        }

        .plan-card {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 82% 15%, rgba(255, 208, 79, .28), transparent 23%),
                linear-gradient(135deg, #020817, #061b51 55%, #003fbd);
            color: white;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 24px 58px rgba(2, 15, 55, .28);
            min-height: 560px;
        }

        .plan-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.045) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: .55;
        }

        .plan-inner {
            position: relative;
            z-index: 2;
        }

        .tag {
            display: inline-flex;
            background: rgba(255, 208, 79, .14);
            color: #ffd04f;
            border: 1px solid rgba(255, 208, 79, .45);
            border-radius: 999px;
            padding: 9px 15px;
            font-size: 13px;
            font-weight: 950;
            margin-bottom: 18px;
        }

        .plan-card h1 {
            margin: 0;
            font-size: 40px;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .price {
            margin: 18px 0;
            font-size: 54px;
            font-weight: 950;
            color: #ffd04f;
        }

        .price small {
            font-size: 16px;
            color: #dce9ff;
            font-weight: 800;
        }

        .plan-details {
            display: grid;
            gap: 14px;
            margin-top: 24px;
        }

        .detail {
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 18px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .detail-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: #ffd04f;
            color: #06143d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex: 0 0 auto;
        }

        .detail strong {
            display: block;
            font-size: 15px;
        }

        .detail span {
            color: #dce9ff;
            font-size: 13px;
            font-weight: 700;
        }

        .voucher-note {
            margin-top: 24px;
            background: rgba(34, 197, 94, .14);
            border: 1px solid rgba(34, 197, 94, .36);
            color: #d6ffe4;
            border-radius: 18px;
            padding: 16px;
            line-height: 1.55;
            font-weight: 750;
        }

        .form-card {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 30px;
            padding: 32px;
            box-shadow: 0 20px 48px rgba(4, 33, 91, .12);
        }

        .form-card h2 {
            margin: 0 0 8px;
            font-size: 31px;
        }

        .form-card p {
            margin: 0 0 22px;
            color: #51617e;
            font-weight: 650;
            line-height: 1.55;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #06143d;
            font-weight: 900;
        }

        input {
            width: 100%;
            height: 52px;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            padding: 0 15px;
            font-size: 15px;
            outline: none;
            background: #fbfdff;
        }

        input:focus {
            border-color: #0b63f6;
            box-shadow: 0 0 0 4px rgba(11, 99, 246, .10);
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            font-weight: 800;
            margin-top: 5px;
        }

        .pay-btn {
            width: 100%;
            height: 56px;
            border: 0;
            border-radius: 15px;
            background: #0b63f6;
            color: white;
            font-size: 17px;
            font-weight: 950;
            cursor: pointer;
            box-shadow: 0 14px 28px rgba(11, 99, 246, .22);
            margin-top: 8px;
        }

        .secure-box {
            margin-top: 18px;
            background: #eff6ff;
            color: #1e3a8a;
            border-radius: 16px;
            padding: 14px;
            line-height: 1.55;
            font-weight: 750;
        }

        .summary {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 9px 0;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 800;
        }

        .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-row span {
            color: #475569;
        }

        .summary-row strong {
            color: #06143d;
            text-align: right;
        }

        @media(max-width: 900px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .plan-card {
                min-height: auto;
            }

            .topbar-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media(max-width: 560px) {
            .wrap {
                padding: 0 14px;
                margin: 24px auto;
            }

            .plan-card,
            .form-card {
                padding: 22px;
                border-radius: 24px;
            }

            .plan-card h1 {
                font-size: 32px;
            }

            .price {
                font-size: 42px;
            }

            .summary-row {
                flex-direction: column;
            }

            .summary-row strong {
                text-align: left;
            }
        }
    </style>
</head>
<body>

@php
    $validity = ((int) $plan->validity_value === 1)
        ? '24 Hours'
        : $plan->validity_value . ' ' . ucfirst($plan->validity_unit);

    $dataLabel = $plan->data_limit_mb >= 1024
        ? rtrim(rtrim(number_format($plan->data_limit_mb / 1024, 2), '0'), '.') . 'GB'
        : $plan->data_limit_mb . 'MB';

    $speed = $plan->speed_limit ?: 'Best Effort';
@endphp

<header class="topbar">
    <div class="topbar-inner">
        <a href="{{ route('portal.home') }}" class="brand">
            <div class="logo">W</div>
            Wave<span>ISP</span>
        </a>

        <div class="nav-links">
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}">Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
        </div>
    </div>
</header>

<main class="wrap">
    <div class="checkout-grid">
        <section class="plan-card">
            <div class="plan-inner">
                <div class="tag">SELECTED DATA PLAN</div>

                <h1>{{ $plan->name }}</h1>

                <div class="price">
                    ₦{{ number_format($plan->price, 0) }}
                    <small>/ {{ $validity }}</small>
                </div>

                <div class="plan-details">
                    <div class="detail">
                        <div class="detail-icon">💽</div>
                        <div>
                            <strong>{{ $dataLabel }} Data Package</strong>
                            <span>Use for browsing, work, study, streaming and smart devices.</span>
                        </div>
                    </div>

                    <div class="detail">
                        <div class="detail-icon">🕒</div>
                        <div>
                            <strong>{{ $validity }} Validity</strong>
                            <span>Your plan remains active until the validity expires or data is used.</span>
                        </div>
                    </div>

                    <div class="detail">
                        <div class="detail-icon">⚡</div>
                        <div>
                            <strong>{{ $speed }} Speed</strong>
                            <span>Optimized for affordable hotspot internet access.</span>
                        </div>
                    </div>

                    <div class="detail">
                        <div class="detail-icon">🔐</div>
                        <div>
                            <strong>Password Voucher Login</strong>
                            <span>After payment, you will receive one voucher password to connect.</span>
                        </div>
                    </div>
                </div>

                <div class="voucher-note">
                    No username will be shown to the customer. Your voucher password is your access code for internet login.
                </div>
            </div>
        </section>

        <section class="form-card">
            <h2>Complete Your Purchase</h2>

            <p>
                Enter your details below. After payment, WaveISP will generate your
                internet voucher password and activate your selected data plan.
            </p>

            <div class="summary">
                <div class="summary-row">
                    <span>Plan</span>
                    <strong>{{ $plan->name }}</strong>
                </div>

                <div class="summary-row">
                    <span>Data</span>
                    <strong>{{ $dataLabel }}</strong>
                </div>

                <div class="summary-row">
                    <span>Validity</span>
                    <strong>{{ $validity }}</strong>
                </div>

                <div class="summary-row">
                    <span>Total</span>
                    <strong>₦{{ number_format($plan->price, 0) }}</strong>
                </div>
            </div>

            <form method="POST" action="{{ route('portal.buy.submit', $plan) }}">
                @csrf

                <div class="field">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Enter your full name" required>
                    @error('full_name') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Example: 08123456789" required>
                    @error('phone') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label>Email Address Optional</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com">
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>

                <input type="hidden" name="hotspot_login" value="{{ $hotspot['login'] ?? '' }}">
                <input type="hidden" name="hotspot_mac" value="{{ $hotspot['mac'] ?? '' }}">
                <input type="hidden" name="hotspot_ip" value="{{ $hotspot['ip'] ?? '' }}">
                <input type="hidden" name="hotspot_dst" value="{{ $hotspot['dst'] ?? '' }}">

                <button type="submit" class="pay-btn">
                    Continue to Payment →
                </button>
            </form>

            <div class="secure-box">
                🔒 Secure checkout. Your voucher password will be created after successful payment.
            </div>
        </section>
    </div>
</main>

</body>
</html>
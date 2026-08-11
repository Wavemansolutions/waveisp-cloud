<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support - WaveISP</title>
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
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 18px;
        }

        .support-card:nth-child(2) .support-icon {
            background: #e9faef;
            color: #20bb69;
        }

        .support-card:nth-child(3) .support-icon {
            background: #f0e9ff;
            color: #642de9;
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
            background: #0b63f6;
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 850;
        }

        .green {
            background: #20bb69;
        }

        .purple {
            background: #642de9;
        }

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

        .faq-item:last-child {
            border-bottom: 0;
        }

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

            .support-grid {
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
            Need <span>Support?</span>
        </h1>

        <p>
            Get help with payment, connection, expired plan, or data exhaustion.
        </p>

        <div class="separator-lines">
            <div class="separator-line"></div>
            <div class="separator-line small"></div>
        </div>
    </div>
</div>

<section class="support-wrap">
    <div class="support-grid">
        <div class="support-card">
            <div class="support-icon">💬</div>
            <h3>WhatsApp Support</h3>
            <p>
                Chat with WaveISP support for quick help with payment,
                login, connection, or plan activation.
            </p>
            <a href="https://wa.me/2348136963037" class="support-btn green">
                Chat on WhatsApp
            </a>
        </div>

        <div class="support-card">
            <div class="support-icon">📞</div>
            <h3>Call Support</h3>
            <p>
                Speak directly with support if your payment succeeded
                but internet access did not activate.
            </p>
            <a href="tel:+2348136963037" class="support-btn">
                +234 813 696 3037
            </a>
        </div>

        <div class="support-card">
            <div class="support-icon">📶</div>
            <h3>Connection Help</h3>
            <p>
                Restart Wi-Fi, reconnect to the hotspot, then open
                neverssl.com if the captive portal does not appear.
            </p>
            <a href="{{ route('portal.plans') }}" class="support-btn purple">
                View Plans
            </a>
        </div>
    </div>

    <div class="faq-box">
        <h2>Frequently Asked Questions</h2>

        <div class="faq-item">
            <strong>My payment was successful but I am not connected.</strong>
            <span>Please contact support with your phone number and payment reference.</span>
        </div>

        <div class="faq-item">
            <strong>Can I reconnect after restarting my phone?</strong>
            <span>Yes. If your data is still valid and not exhausted, reconnect to the Wi-Fi and the system should reconnect you.</span>
        </div>

        <div class="faq-item">
            <strong>What happens when my data finishes?</strong>
            <span>You will be redirected to buy another data package.</span>
        </div>

        <div class="faq-item">
            <strong>Can I get free trial access?</strong>
            <span>Yes. The system is designed to support a free 50MB trial before payment.</span>
        </div>
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
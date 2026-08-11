<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WaveISP - Fast Affordable Internet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
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
            padding: 18px 24px 0;
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

        .wifi-mark {
            width: 58px;
            height: 46px;
            position: relative;
        }

        .wifi-mark span {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            border: 6px solid #0b63f6;
            border-bottom: 0;
            border-radius: 70px 70px 0 0;
        }

        .wifi-mark .w1 {
            width: 58px;
            height: 29px;
            top: 0;
        }

        .wifi-mark .w2 {
            width: 42px;
            height: 22px;
            top: 11px;
        }

        .wifi-mark .w3 {
            width: 26px;
            height: 14px;
            top: 23px;
        }

        .wifi-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #0b63f6;
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
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
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: #0b63f6;
            color: white;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 800;
            box-shadow: 0 9px 20px rgba(11, 99, 246, 0.25);
        }

        .hero {
            max-width: 1480px;
            margin: 0 auto;
            min-height: 350px;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            align-items: center;
            padding: 48px 80px 34px;
            overflow: hidden;
        }

        .hero h1 {
            margin: 0;
            font-size: 54px;
            line-height: 1.1;
            letter-spacing: -2px;
            color: #06143d;
        }

        .hero h1 span {
            color: #0b63f6;
        }

        .hero p {
            max-width: 560px;
            margin: 18px 0 28px;
            color: #263b69;
            font-size: 17px;
            line-height: 1.55;
            font-weight: 500;
        }

        .hero-actions {
            display: flex;
            gap: 22px;
            flex-wrap: wrap;
        }

        .primary-btn,
        .outline-btn {
            min-width: 194px;
            height: 54px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-weight: 800;
            font-size: 16px;
        }

        .primary-btn {
            background: #0b63f6;
            color: white;
            box-shadow: 0 12px 24px rgba(11, 99, 246, 0.22);
        }

        .outline-btn {
            background: white;
            color: #0b63f6;
            border: 2px solid #0b63f6;
        }

        .hero-visual {
            position: relative;
            height: 350px;
            perspective: 1200px;
        }

        .hero-glow {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 65% 38%, rgba(71, 145, 255, 0.30), transparent 22%),
                radial-gradient(circle at 76% 18%, rgba(255, 255, 255, 0.55), transparent 10%),
                radial-gradient(circle at 32% 85%, rgba(16, 92, 255, 0.18), transparent 22%);
            filter: blur(8px);
        }

        .globe {
            width: 225px;
            height: 225px;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            left: 175px;
            background:
                radial-gradient(circle at 30% 30%, #dff3ff 0%, #87c8ff 18%, #2f86ff 45%, #0950c7 78%, #063c99 100%);
            box-shadow:
                inset -22px -28px 42px rgba(0, 18, 79, 0.32),
                inset 18px 16px 28px rgba(255, 255, 255, 0.25),
                0 30px 50px rgba(3, 47, 141, 0.30),
                0 0 0 2px rgba(255,255,255,0.35);
            animation: floatGlobe 5.5s ease-in-out infinite;
        }

        .globe::before {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: 50%;
            background:
                radial-gradient(circle at 58% 34%, rgba(255,255,255,0.95) 0 2px, transparent 3px),
                radial-gradient(circle at 34% 58%, rgba(255,255,255,0.95) 0 2px, transparent 3px),
                radial-gradient(circle at 70% 60%, rgba(255,255,255,0.95) 0 2px, transparent 3px),
                radial-gradient(circle at 45% 20%, rgba(255,255,255,0.75) 0 4px, transparent 5px),
                linear-gradient(transparent 47%, rgba(255,255,255,0.28) 48%, transparent 49%),
                linear-gradient(90deg, transparent 47%, rgba(255,255,255,0.22) 48%, transparent 49%);
            border: 2px solid rgba(255,255,255,0.30);
        }

        .globe::after {
            content: "";
            position: absolute;
            left: -24px;
            top: 76px;
            width: 272px;
            height: 88px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.75);
            transform: rotate(-14deg);
            box-shadow: 0 0 18px rgba(255,255,255,0.30);
        }

        .orbit {
            position: absolute;
            left: 132px;
            top: 58px;
            width: 310px;
            height: 128px;
            border: 2px solid rgba(255,255,255,0.75);
            border-radius: 50%;
            transform: rotate(24deg);
            box-shadow: 0 0 20px rgba(255,255,255,0.22);
        }

        .orbit::before,
        .orbit::after {
            content: "";
            position: absolute;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 18px rgba(255,255,255,0.85);
        }

        .orbit::before {
            top: 20px;
            left: 42px;
        }

        .orbit::after {
            right: 50px;
            bottom: 18px;
        }

        .router-shadow {
            position: absolute;
            width: 190px;
            height: 24px;
            background: rgba(0,0,0,0.15);
            filter: blur(12px);
            border-radius: 50%;
            left: 44px;
            top: 282px;
        }

        .router {
            width: 210px;
            height: 86px;
            position: absolute;
            left: 28px;
            top: 205px;
            border-radius: 16px 16px 28px 28px;
            background:
                linear-gradient(180deg, #1e73ff 0%, #0a51d5 62%, #063eaa 100%);
            box-shadow:
                0 24px 34px rgba(1, 39, 122, 0.30),
                inset 0 2px 0 rgba(255,255,255,0.30),
                inset 0 -8px 18px rgba(0,0,0,0.20);
            transform: rotate(-6deg);
            animation: floatRouter 4.5s ease-in-out infinite;
        }

        .router::before,
        .router::after {
            content: "";
            position: absolute;
            width: 8px;
            height: 92px;
            background: linear-gradient(180deg, #081737, #132e6a);
            border-radius: 8px;
            top: -83px;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.10);
        }

        .router::before {
            left: 54px;
        }

        .router::after {
            right: 54px;
        }

        .router-top {
            position: absolute;
            left: 10px;
            right: 10px;
            top: 10px;
            height: 18px;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(255,255,255,0.20), rgba(255,255,255,0.02));
        }

        .lights {
            display: flex;
            gap: 8px;
            position: absolute;
            right: 22px;
            bottom: 18px;
        }

        .lights span {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #2cff89;
            box-shadow: 0 0 14px #2cff89;
        }

        .laptop {
            position: absolute;
            right: 30px;
            bottom: 6px;
            width: 188px;
            height: 112px;
            transform: rotate(12deg);
            animation: floatLaptop 5s ease-in-out infinite;
        }

        .laptop-screen {
            width: 100%;
            height: 100%;
            border-radius: 12px;
            border: 8px solid #d7e6ff;
            background:
                radial-gradient(circle at 70% 30%, rgba(118, 198, 255, 0.55), transparent 24%),
                linear-gradient(135deg, #06143d, #0a4fc8);
            box-shadow:
                0 18px 34px rgba(3, 26, 85, 0.28),
                inset 0 0 30px rgba(255,255,255,0.08);
            position: relative;
            overflow: hidden;
        }

        .laptop-screen::before {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.18);
        }

        .laptop-base {
            width: calc(100% + 36px);
            height: 18px;
            background: linear-gradient(180deg, #e9f2ff, #bfd5f7);
            border-radius: 0 0 18px 18px;
            position: absolute;
            left: -18px;
            bottom: -20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.12);
        }

        .floating-wifi {
            position: absolute;
            top: 26px;
            right: 122px;
            width: 92px;
            height: 92px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.94), rgba(236,244,255,0.90));
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            transform: rotate(10deg);
            box-shadow:
                0 20px 34px rgba(0, 55, 160, 0.16),
                inset 0 1px 0 rgba(255,255,255,0.85);
            animation: floatWifi 4.2s ease-in-out infinite;
        }

        .hero-separator {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4px 24px 12px;
        }

        .separator-lines {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
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
            margin: 0 auto;
            padding: 0 24px 18px;
        }

        .section-title {
            text-align: center;
            margin: 0 0 12px;
            font-size: 24px;
            font-weight: 900;
            color: #06143d;
        }

        .section-title span {
            color: #0b63f6;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
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
            display: flex;
            align-items: center;
            gap: 6px;
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

        .features .mini {
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

        .how {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px 14px;
        }

        .steps {
            display: grid;
            grid-template-columns: 1fr 44px 1fr 44px 1fr;
            gap: 16px;
            align-items: center;
        }

        .step {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 13px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            min-height: 88px;
            box-shadow: 0 7px 18px rgba(5, 35, 93, 0.07);
        }

        .step-icon {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #e9f3ff;
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 29px;
            flex: 0 0 auto;
        }

        .step h4 {
            margin: 0;
            font-size: 16px;
        }

        .step p {
            margin: 3px 0 0;
            color: #435273;
            font-size: 13px;
            font-weight: 600;
        }

        .num {
            display: inline-flex;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background: #0b63f6;
            color: white;
            font-size: 12px;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .arrow {
            text-align: center;
            color: #071743;
            font-size: 30px;
            font-weight: 400;
        }

        .benefits {
            max-width: 1280px;
            margin: 0 auto 14px;
            padding: 0 24px;
        }

        .benefit-box {
            background: white;
            border-radius: 18px;
            box-shadow: 0 12px 25px rgba(5, 35, 93, 0.10);
            padding: 18px 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .benefit {
            display: flex;
            align-items: center;
            gap: 17px;
            border-right: 1px solid #d7dfeb;
            padding-right: 16px;
        }

        .benefit:last-child {
            border-right: 0;
        }

        .benefit-icon {
            width: 61px;
            height: 61px;
            border-radius: 50%;
            background: #eaf3ff;
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            flex: 0 0 auto;
        }

        .benefit:nth-child(2) .benefit-icon {
            background: #e9faef;
            color: #20bb69;
        }

        .benefit:nth-child(3) .benefit-icon {
            background: #f0e9ff;
            color: #642de9;
        }

        .benefit h4 {
            margin: 0;
            font-size: 16px;
        }

        .benefit p {
            margin: 4px 0 0;
            color: #344465;
            font-size: 13px;
            line-height: 1.3;
            font-weight: 600;
        }

        .support {
            max-width: 1280px;
            margin: 0 auto 0;
            padding: 0 24px;
        }

        .support-bar {
            background: linear-gradient(90deg, #06205d, #003fbd, #06205d);
            border-radius: 18px;
            color: white;
            padding: 20px 34px;
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr;
            gap: 34px;
            box-shadow: 0 15px 35px rgba(0, 38, 116, 0.25);
        }

        .support-item {
            display: flex;
            align-items: center;
            gap: 20px;
            border-right: 1px solid rgba(255,255,255,0.45);
            padding-right: 20px;
        }

        .support-item:last-child {
            border-right: 0;
        }

        .support-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #20d365;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 33px;
            flex: 0 0 auto;
        }

        .support-item:nth-child(2) .support-icon,
        .support-item:nth-child(3) .support-icon {
            background: #1e70ff;
        }

        .support-item h4 {
            margin: 0;
            font-size: 17px;
        }

        .support-item p {
            margin: 3px 0 8px;
            color: #dbe8ff;
            font-size: 13px;
            font-weight: 600;
        }

        .whatsapp-btn,
        .faq-btn {
            display: inline-flex;
            background: white;
            color: #14a34a;
            padding: 8px 23px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 850;
        }

        .faq-btn {
            color: #0b63f6;
            border-radius: 6px;
        }

        .phone {
            font-size: 21px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .footer {
            margin-top: 6px;
            background: #061b51;
            color: white;
            padding: 24px;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.7fr 0.8fr 0.8fr 0.8fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .small-mark {
            transform: scale(0.78);
            transform-origin: left center;
        }

        .footer h5 {
            margin: 0 0 10px;
            font-size: 15px;
        }

        .footer a,
        .footer p {
            display: block;
            margin: 4px 0;
            color: #dbe8ff;
            font-size: 13px;
        }

        .social {
            display: flex;
            gap: 13px;
            margin-top: 10px;
        }

        .social span {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            background: white;
            color: #061b51;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 13px;
        }

        .copy {
            color: #b4c6e9;
            font-size: 12px;
            margin-top: 22px;
            text-align: center;
        }

        @@keyframes floatGlobe {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @@keyframes floatRouter {
            0%, 100% { transform: rotate(-6deg) translateY(0px); }
            50% { transform: rotate(-6deg) translateY(-8px); }
        }

        @@keyframes floatLaptop {
            0%, 100% { transform: rotate(12deg) translateY(0px); }
            50% { transform: rotate(12deg) translateY(-9px); }
        }

        @@keyframes floatWifi {
            0%, 100% { transform: rotate(10deg) translateY(0px); }
            50% { transform: rotate(10deg) translateY(-7px); }
        }

        @@media (max-width: 1100px) {
            .navbar {
                padding: 13px 24px;
            }

            .nav-links {
                gap: 22px;
            }

            .hero {
                grid-template-columns: 1fr;
                padding: 42px 28px 30px;
            }

            .hero-visual {
                display: none;
            }

            .plans-grid,
            .benefit-box,
            .support-bar,
            .footer-inner {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .arrow {
                display: none;
            }

            .benefit,
            .support-item {
                border-right: 0;
                border-bottom: 1px solid #d7dfeb;
                padding-bottom: 14px;
            }

            .support-item {
                border-bottom-color: rgba(255,255,255,0.35);
            }
        }

        @@media (max-width: 760px) {
            .top-shell {
                padding: 10px 10px 0;
            }

            .navbar {
                flex-direction: column;
                gap: 16px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .hero h1 {
                font-size: 39px;
            }

            .plans-grid {
                gap: 22px;
            }

            .plan-card h3,
            .price {
                margin-left: 76px;
            }

            .brand-text strong {
                font-size: 27px;
            }

            .separator-lines {
                gap: 10px;
            }

            .separator-line {
                width: 90px;
                height: 4px;
            }

            .separator-line.small {
                width: 55px;
            }
        }
    </style>
</head>
<body>

<div class="top-shell">
    <nav class="navbar">
        <a href="{{ route('portal.home') }}" class="brand">
            <div class="wifi-mark">
                <span class="w1"></span>
                <span class="w2"></span>
                <span class="w3"></span>
                <div class="wifi-dot"></div>
            </div>

            <div class="brand-text">
                <strong>Wave<span>ISP</span></strong>
                <small>Connect. Surf. Live.</small>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('portal.home') }}" class="active">Home</a>
            <a href="{{ route('portal.plans') }}">Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
            <a href="/admin/login">Login</a>
        </div>

        <a href="{{ route('portal.plans') }}" class="connect-btn">
            ⚡ Get Connected
        </a>
    </nav>

    <section class="hero">
        <div>
            <h1>
                Fast, Affordable
                <br>
                <span>Internet</span> for Everyone
            </h1>

            <p>
                Buy hotspot data plans instantly and stay connected
                anytime, anywhere with WaveISP.
            </p>

            <div class="hero-actions">
                <a href="{{ route('portal.plans') }}" class="primary-btn">
                    🛒 Buy Plan
                </a>

                <a href="/admin/login" class="outline-btn">
                    👤 Customer Login
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="hero-glow"></div>

            <div class="globe"></div>
            <div class="orbit"></div>

            <div class="router-shadow"></div>
            <div class="router">
                <div class="router-top"></div>
                <div class="lights">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="floating-wifi">📶</div>

            <div class="laptop">
                <div class="laptop-screen"></div>
                <div class="laptop-base"></div>
            </div>
        </div>
    </section>
</div>

<div class="hero-separator">
    <div class="separator-lines">
        <div class="separator-line"></div>
        <div class="separator-line small"></div>
    </div>
</div>

<section id="plans" class="plans-section">
    <h2 class="section-title">
        Choose the <span>Perfect Plan</span> for You
    </h2>

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

                $buyUrl = route(
                    'portal.buy',
                    array_merge(
                        ['plan' => $plan],
                        request()->only([
                            'hotspot_login',
                            'hotspot_mac',
                            'hotspot_ip',
                            'hotspot_dst'
                        ])
                    )
                );
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

                <a href="{{ $buyUrl }}" class="buy-now">
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
                    <li><span class="mini">⚡</span> Add internet plans</li>
                    <li><span class="mini">💽</span> Refresh page</li>
                </ul>

                <a href="/admin/login" class="buy-now">
                    Admin Login →
                </a>
            </div>
        @endforelse
    </div>
</section>

<section class="how">
    <h2 class="section-title">
        How <span>It Works</span>
    </h2>

    <div class="steps">
        <div class="step">
            <div class="step-icon">☑</div>
            <div>
                <h4><span class="num">1</span>Choose a Plan</h4>
                <p>Pick the plan that suits your needs.</p>
            </div>
        </div>

        <div class="arrow">→</div>

        <div class="step">
            <div class="step-icon">💳</div>
            <div>
                <h4><span class="num">2</span>Make Payment</h4>
                <p>Pay securely via our trusted payment options.</p>
            </div>
        </div>

        <div class="arrow">→</div>

        <div class="step">
            <div class="step-icon">📶</div>
            <div>
                <h4><span class="num">3</span>Start Browsing</h4>
                <p>Get instant access and enjoy fast internet.</p>
            </div>
        </div>
    </div>
</section>

<section class="benefits">
    <div class="benefit-box">
        <div class="benefit">
            <div class="benefit-icon">🚀</div>
            <div>
                <h4>Instant Activation</h4>
                <p>Plans are activated instantly after successful payment.</p>
            </div>
        </div>

        <div class="benefit">
            <div class="benefit-icon">🔒</div>
            <div>
                <h4>Secure Payments</h4>
                <p>Your payments are protected with industry-standard security.</p>
            </div>
        </div>

        <div class="benefit">
            <div class="benefit-icon">🎧</div>
            <div>
                <h4>Fast Support</h4>
                <p>Our support team is always ready to help you.</p>
            </div>
        </div>

        <div class="benefit">
            <div class="benefit-icon">🛡</div>
            <div>
                <h4>Reliable Connection</h4>
                <p>Enjoy stable and high-speed internet always.</p>
            </div>
        </div>
    </div>
</section>

<section id="support" class="support">
    <div class="support-bar">
        <div class="support-item">
            <div class="support-icon">☎</div>
            <div>
                <h4>Need Help? Chat on WhatsApp</h4>
                <p>We are online and ready to assist you.</p>
                <a href="https://wa.me/2348136963037" class="whatsapp-btn">💬 Chat on WhatsApp</a>
            </div>
        </div>

        <div class="support-item">
            <div class="support-icon">📞</div>
            <div>
                <h4>Call Support</h4>
                <p>Speak with our support team.</p>
                <div class="phone">+234 813 696 3037</div>
            </div>
        </div>

        <div class="support-item">
            <div class="support-icon">?</div>
            <div>
                <h4>Have Questions?</h4>
                <p>Visit our FAQ or Help Center for answers.</p>
                <a href="{{ route('portal.plans') }}" class="faq-btn">View Plans</a>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-inner">
        <div>
            <div class="footer-logo">
                <div class="wifi-mark small-mark">
                    <span class="w1"></span>
                    <span class="w2"></span>
                    <span class="w3"></span>
                    <div class="wifi-dot"></div>
                </div>

                <div class="brand-text">
                    <strong style="color:white;">Wave<span style="color:white;">ISP</span></strong>
                    <small style="color:#dbe8ff;">Connect. Surf. Live.</small>
                </div>
            </div>
        </div>

        <div>
            <h5>Quick Links</h5>
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}">Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
            <a href="/admin/login">Login</a>
        </div>

        <div>
            <h5>Legal</h5>
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Refund Policy</a>
        </div>

        <div>
            <h5>Company</h5>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Status</a>
        </div>

        <div>
            <h5>Follow Us</h5>
            <div class="social">
                <span>f</span>
                <span>x</span>
                <span>◎</span>
                <span>▶</span>
            </div>
        </div>
    </div>

    <div class="copy">
        © 2026 WaveISP. All rights reserved.
    </div>
</footer>

</body>
</html>
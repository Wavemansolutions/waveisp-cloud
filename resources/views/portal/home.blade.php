<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WaveISP - Hotspot Billing Business</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f6f9ff;
            color: #06143d;
        }

        a { text-decoration: none; }

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
            box-shadow: 0 10px 22px rgba(11, 99, 246, 0.24);
        }

        .brand-text strong {
            display: block;
            color: #0b63f6;
            font-size: 31px;
            line-height: 1;
            letter-spacing: -1px;
        }

        .brand-text strong span { color: #06143d; }

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
            min-height: 385px;
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            align-items: center;
            padding: 54px 80px 44px;
            overflow: hidden;
        }

        .hero h1 {
            margin: 0;
            font-size: 56px;
            line-height: 1.1;
            letter-spacing: -2px;
            color: #06143d;
        }

        .hero h1 span { color: #0b63f6; }

        .hero p {
            max-width: 620px;
            margin: 18px 0 28px;
            color: #263b69;
            font-size: 18px;
            line-height: 1.6;
            font-weight: 600;
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
            background: linear-gradient(180deg, #1e73ff 0%, #0a51d5 62%, #063eaa 100%);
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
        }

        .router::before { left: 54px; }
        .router::after { right: 54px; }

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

        .separator {
            max-width: 1280px;
            margin: 0 auto;
            padding: 6px 24px 20px;
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

        .business-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 26px 24px 42px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 26px;
        }

        .section-title h2 {
            margin: 0;
            font-size: 36px;
            font-weight: 950;
            color: #06143d;
        }

        .section-title h2 span { color: #0b63f6; }

        .section-title p {
            margin: 10px auto 0;
            max-width: 760px;
            color: #435273;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.6;
        }

        .business-card {
            background: white;
            border-radius: 26px;
            box-shadow: 0 18px 45px rgba(4, 33, 91, 0.12);
            border: 1px solid #dfe7f5;
            padding: 34px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 34px;
            align-items: center;
        }

        .hotspot-picture {
            background:
                radial-gradient(circle at top right, rgba(11, 99, 246, 0.18), transparent 30%),
                linear-gradient(135deg, #eef6ff, #ffffff);
            border: 1px solid #d7e5fb;
            border-radius: 24px;
            padding: 28px;
            position: relative;
            min-height: 390px;
            overflow: hidden;
        }

        .diagram-title {
            position: absolute;
            top: 22px;
            left: 28px;
            background: #061b51;
            color: white;
            border-radius: 999px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 900;
        }

        .tower {
            position: absolute;
            left: 55px;
            top: 95px;
            width: 92px;
            height: 190px;
        }

        .tower .mast {
            position: absolute;
            left: 41px;
            top: 28px;
            width: 10px;
            height: 150px;
            background: #0b63f6;
            border-radius: 10px;
        }

        .tower .base {
            position: absolute;
            left: 10px;
            bottom: 0;
            width: 72px;
            height: 18px;
            background: #06143d;
            border-radius: 18px;
        }

        .signal {
            position: absolute;
            left: 17px;
            border: 4px solid #0b63f6;
            border-bottom: 0;
            border-radius: 120px 120px 0 0;
            opacity: 0.85;
        }

        .signal.one { top: 0; width: 58px; height: 30px; }
        .signal.two { top: -22px; left: 4px; width: 84px; height: 50px; opacity: 0.55; }

        .cloud {
            position: absolute;
            left: 215px;
            top: 76px;
            width: 190px;
            height: 86px;
            background: #0b63f6;
            border-radius: 44px;
            box-shadow: 0 18px 36px rgba(11, 99, 246, 0.24);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 950;
            line-height: 1.2;
        }

        .cloud::before,
        .cloud::after {
            content: "";
            position: absolute;
            background: #0b63f6;
            border-radius: 50%;
            top: -28px;
        }

        .cloud::before {
            width: 78px;
            height: 78px;
            left: 28px;
        }

        .cloud::after {
            width: 64px;
            height: 64px;
            right: 30px;
            top: -20px;
        }

        .cloud span {
            position: relative;
            z-index: 2;
        }

        .flow-line {
            position: absolute;
            height: 4px;
            background: linear-gradient(90deg, #0b63f6, #59a3ff);
            border-radius: 999px;
        }

        .line-one {
            left: 145px;
            top: 182px;
            width: 88px;
            transform: rotate(-18deg);
        }

        .line-two {
            left: 320px;
            top: 188px;
            width: 95px;
            transform: rotate(22deg);
        }

        .mikrotik-box {
            position: absolute;
            right: 42px;
            top: 180px;
            width: 185px;
            min-height: 92px;
            background: #061b51;
            color: white;
            border-radius: 18px;
            box-shadow: 0 18px 38px rgba(6, 27, 81, 0.24);
            padding: 16px;
            text-align: center;
        }

        .mikrotik-box strong {
            display: block;
            font-size: 17px;
            margin-bottom: 5px;
        }

        .mikrotik-box small {
            color: #dbe8ff;
            font-weight: 700;
        }

        .customers {
            position: absolute;
            left: 110px;
            right: 52px;
            bottom: 34px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .customer-device {
            background: white;
            border: 1px solid #dce8fb;
            border-radius: 16px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 12px 24px rgba(4, 33, 91, 0.10);
            font-weight: 850;
            color: #17264d;
        }

        .customer-device .icon {
            font-size: 26px;
            display: block;
            margin-bottom: 6px;
        }

        .business-text h3 {
            margin: 0 0 14px;
            font-size: 30px;
            line-height: 1.2;
            color: #06143d;
        }

        .business-text h3 span { color: #0b63f6; }

        .business-text p {
            color: #435273;
            line-height: 1.7;
            font-size: 16px;
            font-weight: 600;
        }

        .business-steps {
            margin-top: 20px;
            display: grid;
            gap: 14px;
        }

        .business-step {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            background: #f6f9ff;
            border: 1px solid #e1eafa;
            border-radius: 16px;
            padding: 15px;
        }

        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            flex: 0 0 auto;
        }

        .business-step strong {
            display: block;
            color: #06143d;
            margin-bottom: 3px;
        }

        .business-step span {
            color: #435273;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.4;
        }

        .benefit-showcase {
            max-width: 1280px;
            margin: 0 auto;
            padding: 10px 24px 42px;
        }

        .benefit-hero-card {
            background:
                radial-gradient(circle at 85% 20%, rgba(255, 196, 51, 0.24), transparent 22%),
                radial-gradient(circle at 15% 80%, rgba(11, 99, 246, 0.24), transparent 26%),
                linear-gradient(135deg, #020b26 0%, #061b51 48%, #001442 100%);
            border-radius: 30px;
            color: white;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(3, 21, 72, 0.26);
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 30px;
            padding: 38px;
            position: relative;
            border: 1px solid rgba(255,255,255,0.12);
        }

        .benefit-hero-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.55;
            pointer-events: none;
        }

        .benefit-copy {
            position: relative;
            z-index: 2;
        }

        .benefit-copy .tag {
            display: inline-flex;
            background: rgba(255, 196, 51, 0.14);
            color: #ffd04f;
            border: 1px solid rgba(255, 196, 51, 0.42);
            border-radius: 999px;
            padding: 9px 16px;
            font-weight: 900;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .benefit-copy h2 {
            margin: 0;
            font-size: 46px;
            line-height: 1.08;
            letter-spacing: -1.5px;
            font-weight: 950;
        }

        .benefit-copy h2 span {
            color: #ffd04f;
        }

        .benefit-copy p {
            color: #dce9ff;
            line-height: 1.7;
            font-size: 16px;
            font-weight: 600;
            max-width: 560px;
            margin: 18px 0 22px;
        }

        .benefit-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .benefit-primary,
        .benefit-secondary {
            min-height: 48px;
            padding: 0 22px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
        }

        .benefit-primary {
            background: #ffd04f;
            color: #06143d;
        }

        .benefit-secondary {
            background: rgba(255,255,255,0.10);
            color: white;
            border: 1px solid rgba(255,255,255,0.22);
        }

        .benefit-visual {
            position: relative;
            z-index: 2;
            min-height: 460px;
        }

        .smart-house {
            position: absolute;
            right: 30px;
            top: 70px;
            width: 420px;
            height: 260px;
            border-radius: 26px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.18), rgba(255,255,255,0.04)),
                #102b68;
            box-shadow: 0 28px 60px rgba(0,0,0,0.30);
            border: 1px solid rgba(255,255,255,0.18);
            overflow: hidden;
        }

        .smart-house::before {
            content: "";
            position: absolute;
            left: 60px;
            right: 60px;
            top: -64px;
            height: 140px;
            background: #0a1a43;
            transform: skewY(-13deg);
            border-radius: 18px;
            box-shadow: 0 16px 30px rgba(0,0,0,0.20);
        }

        .smart-house::after {
            content: "";
            position: absolute;
            left: 34px;
            right: 34px;
            bottom: 38px;
            height: 92px;
            background:
                linear-gradient(90deg, rgba(255,255,255,0.10), rgba(255,255,255,0.02)),
                #06143d;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.14);
        }

        .house-window {
            position: absolute;
            width: 74px;
            height: 72px;
            background: linear-gradient(180deg, #ffd04f, #ff9d1b);
            border-radius: 14px;
            box-shadow: 0 0 30px rgba(255, 196, 51, 0.35);
            bottom: 58px;
            z-index: 3;
        }

        .window-one { left: 62px; }
        .window-two { right: 62px; }

        .dish {
            position: absolute;
            right: 68px;
            top: 28px;
            width: 132px;
            height: 78px;
            background: linear-gradient(135deg, #ffffff, #cbd9f5);
            border-radius: 62% 38% 55% 45%;
            transform: rotate(-18deg);
            box-shadow: 0 18px 32px rgba(0,0,0,0.22);
            z-index: 5;
        }

        .dish::after {
            content: "";
            position: absolute;
            left: 52px;
            bottom: -82px;
            width: 9px;
            height: 90px;
            border-radius: 8px;
            background: #dbe8ff;
            transform: rotate(18deg);
        }

        .signal-ring {
            position: absolute;
            right: 34px;
            top: 34px;
            width: 210px;
            height: 210px;
            border: 2px solid rgba(11, 99, 246, 0.8);
            border-radius: 50%;
            box-shadow: 0 0 28px rgba(11, 99, 246, 0.35);
            animation: pulseRing 2.8s ease-in-out infinite;
        }

        .signal-ring.two {
            right: 2px;
            top: 2px;
            width: 276px;
            height: 276px;
            opacity: 0.45;
            animation-delay: 0.7s;
        }

        .benefit-badges {
            position: absolute;
            left: 4px;
            top: 28px;
            display: grid;
            gap: 14px;
            width: 230px;
        }

        .benefit-badge {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.20);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 13px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 18px 30px rgba(0,0,0,0.18);
        }

        .benefit-badge .badge-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #ffd04f;
            color: #06143d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex: 0 0 auto;
        }

        .benefit-badge strong {
            display: block;
            font-size: 14px;
            line-height: 1.2;
        }

        .benefit-badge small {
            color: #dce9ff;
            font-size: 12px;
            font-weight: 700;
        }

        .device-row {
            position: absolute;
            left: 24px;
            right: 24px;
            bottom: 8px;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .device-item {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.20);
            border-radius: 18px;
            padding: 12px 8px;
            text-align: center;
            color: white;
            font-weight: 850;
            font-size: 12px;
            min-height: 82px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 6px;
        }

        .device-item span {
            font-size: 25px;
        }

        .user-benefits-grid {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .user-benefit {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 12px 28px rgba(5, 35, 93, 0.09);
        }

        .user-benefit .icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #eaf3ff;
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 14px;
        }

        .user-benefit h3 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #06143d;
        }

        .user-benefit p {
            margin: 0;
            color: #435273;
            line-height: 1.5;
            font-weight: 600;
            font-size: 14px;
        }

        .footer-pro {
            background:
                radial-gradient(circle at 20% 0%, rgba(11, 99, 246, 0.22), transparent 24%),
                linear-gradient(135deg, #020b26, #061b51);
            color: white;
            padding: 42px 24px 24px;
            margin-top: 20px;
        }

        .footer-pro-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.4fr 0.8fr 0.8fr 1fr;
            gap: 30px;
        }

        .footer-pro h4 {
            margin: 0 0 14px;
            font-size: 17px;
        }

        .footer-pro p,
        .footer-pro a {
            display: block;
            color: #dbe8ff;
            font-size: 14px;
            line-height: 1.7;
            margin: 3px 0;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-brand strong {
            font-size: 30px;
            color: white;
        }

        .footer-brand span {
            color: #ffd04f;
        }

        .footer-contact-box {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 18px;
            padding: 16px;
        }

        .footer-copy {
            max-width: 1280px;
            margin: 26px auto 0;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,0.12);
            color: #bcd0f5;
            font-size: 13px;
            text-align: center;
            letter-spacing: 2px;
        }

        @keyframes pulseRing {
            0%, 100% {
                transform: scale(1);
                opacity: 0.75;
            }
            50% {
                transform: scale(1.06);
                opacity: 0.35;
            }
        }

        @media (max-width: 1100px) {
            .benefit-hero-card {
                grid-template-columns: 1fr;
            }

            .benefit-visual {
                min-height: 520px;
            }

            .user-benefits-grid,
            .footer-pro-inner {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 760px) {
            .benefit-hero-card {
                padding: 24px;
            }

            .benefit-copy h2 {
                font-size: 34px;
            }

            .benefit-visual {
                min-height: 720px;
            }

            .smart-house {
                width: 100%;
                right: 0;
                top: 260px;
            }

            .benefit-badges {
                left: 0;
                right: 0;
                width: 100%;
            }

            .device-row {
                grid-template-columns: 1fr;
                bottom: 0;
            }

            .user-benefits-grid,
            .footer-pro-inner {
                grid-template-columns: 1fr;
            }
        }
        .customer-pitch-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 26px 24px 42px;
        }

        .customer-pitch-title {
            text-align: center;
            margin-bottom: 28px;
        }

        .customer-pitch-title h2 {
            margin: 0;
            font-size: 38px;
            line-height: 1.15;
            font-weight: 950;
            color: #06143d;
        }

        .customer-pitch-title h2 span {
            color: #0b63f6;
        }

        .customer-pitch-title p {
            margin: 12px auto 0;
            max-width: 820px;
            color: #435273;
            font-size: 17px;
            line-height: 1.6;
            font-weight: 650;
        }

        .customer-pitch-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 18px 45px rgba(4, 33, 91, 0.12);
            border: 1px solid #dfe7f5;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .pitch-photos {
            background:
                radial-gradient(circle at 20% 20%, rgba(11, 99, 246, 0.20), transparent 25%),
                linear-gradient(135deg, #061b51, #0b63f6);
            padding: 26px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            align-content: center;
        }

        .photo-tile {
            min-height: 190px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 18px 34px rgba(0,0,0,0.24);
            border: 1px solid rgba(255,255,255,0.18);
            background: #06143d;
        }

        .photo-tile.large {
            grid-column: span 2;
            min-height: 250px;
        }

        .photo-tile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: saturate(1.08) contrast(1.03);
        }

        .photo-label {
            position: absolute;
            left: 14px;
            bottom: 14px;
            background: rgba(2, 11, 38, 0.78);
            color: white;
            padding: 9px 13px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 900;
            backdrop-filter: blur(6px);
        }

        .pitch-copy {
            padding: 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .pitch-copy .tag {
            display: inline-flex;
            width: fit-content;
            background: #eaf3ff;
            color: #0b63f6;
            border-radius: 999px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 950;
            margin-bottom: 16px;
        }

        .pitch-copy h3 {
            margin: 0;
            font-size: 34px;
            line-height: 1.18;
            color: #06143d;
            font-weight: 950;
        }

        .pitch-copy h3 span {
            color: #0b63f6;
        }

        .pitch-copy p {
            color: #435273;
            line-height: 1.75;
            font-size: 16px;
            font-weight: 650;
            margin: 16px 0 20px;
        }

        .customer-steps {
            display: grid;
            gap: 13px;
            margin-top: 6px;
        }

        .customer-step {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            background: #f6f9ff;
            border: 1px solid #e1eafa;
            border-radius: 16px;
            padding: 15px;
        }

        .customer-step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            flex: 0 0 auto;
        }

        .customer-step strong {
            display: block;
            color: #06143d;
            margin-bottom: 3px;
        }

        .customer-step span {
            color: #435273;
            font-size: 14px;
            font-weight: 650;
            line-height: 1.45;
        }

        .pitch-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .pitch-primary,
        .pitch-secondary {
            min-height: 50px;
            padding: 0 24px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
        }

        .pitch-primary {
            background: #0b63f6;
            color: white;
            box-shadow: 0 12px 24px rgba(11, 99, 246, 0.22);
        }

        .pitch-secondary {
            background: white;
            color: #0b63f6;
            border: 2px solid #0b63f6;
        }

        .mini-benefits {
            margin-top: 28px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .mini-benefit {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 20px;
            padding: 22px;
            box-shadow: 0 12px 28px rgba(5, 35, 93, 0.09);
        }

        .mini-benefit .icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #eaf3ff;
            color: #0b63f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin-bottom: 14px;
        }

        .mini-benefit h3 {
            margin: 0 0 8px;
            font-size: 18px;
            color: #06143d;
        }

        .mini-benefit p {
            margin: 0;
            color: #435273;
            line-height: 1.5;
            font-weight: 650;
            font-size: 14px;
        }

        @media (max-width: 1100px) {
            .customer-pitch-card {
                grid-template-columns: 1fr;
            }

            .mini-benefits {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 760px) {
            .customer-pitch-title h2 {
                font-size: 31px;
            }

            .pitch-photos {
                grid-template-columns: 1fr;
            }

            .photo-tile.large {
                grid-column: span 1;
            }

            .pitch-copy {
                padding: 24px;
            }

            .pitch-copy h3 {
                font-size: 28px;
            }

            .mini-benefits {
                grid-template-columns: 1fr;
            }
        }
        .cta-band {
            max-width: 1280px;
            margin: 0 auto 36px;
            padding: 0 24px;
        }

        .cta-inner {
            background: linear-gradient(90deg, #06205d, #003fbd, #06205d);
            color: white;
            border-radius: 22px;
            padding: 28px 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 15px 35px rgba(0, 38, 116, 0.25);
        }

        .cta-inner h3 {
            margin: 0;
            font-size: 24px;
        }

        .cta-inner p {
            margin: 6px 0 0;
            color: #dbe8ff;
            font-weight: 600;
        }

        .cta-inner a {
            background: white;
            color: #0b63f6;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 950;
            white-space: nowrap;
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

        @keyframes floatGlobe {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes floatRouter {
            0%, 100% { transform: rotate(-6deg) translateY(0px); }
            50% { transform: rotate(-6deg) translateY(-8px); }
        }

        @keyframes floatLaptop {
            0%, 100% { transform: rotate(12deg) translateY(0px); }
            50% { transform: rotate(12deg) translateY(-9px); }
        }

        @keyframes floatWifi {
            0%, 100% { transform: rotate(10deg) translateY(0px); }
            50% { transform: rotate(10deg) translateY(-7px); }
        }

        @media (max-width: 1100px) {
            .navbar { padding: 13px 24px; }
            .nav-links { gap: 22px; }

            .hero {
                grid-template-columns: 1fr;
                padding: 42px 28px 30px;
            }

            .hero-visual { display: none; }

            .business-card {
                grid-template-columns: 1fr;
            }

            .cta-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 760px) {
            .top-shell { padding: 10px 10px 0; }

            .navbar {
                flex-direction: column;
                gap: 16px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .hero h1 { font-size: 39px; }

            .business-card {
                padding: 20px;
            }

            .hotspot-picture {
                min-height: 520px;
            }

            .cloud {
                left: 50%;
                transform: translateX(-50%);
                top: 70px;
            }

            .tower {
                left: 35px;
                top: 210px;
            }

            .mikrotik-box {
                right: 25px;
                top: 225px;
                width: 170px;
            }

            .line-one,
            .line-two {
                display: none;
            }

            .customers {
                left: 24px;
                right: 24px;
                grid-template-columns: 1fr;
                bottom: 24px;
            }
        }
            .waveman-benefits {
            max-width: 1280px;
            margin: 0 auto;
            padding: 28px 24px 46px;
        }

        .waveman-benefits-card {
            position: relative;
            overflow: hidden;
            border-radius: 34px;
            background:
                radial-gradient(circle at 82% 16%, rgba(255, 199, 65, 0.28), transparent 20%),
                radial-gradient(circle at 18% 80%, rgba(11, 99, 246, 0.30), transparent 24%),
                linear-gradient(135deg, #020817 0%, #071d56 48%, #001b5f 100%);
            color: white;
            box-shadow: 0 28px 70px rgba(0, 24, 82, 0.34);
            border: 1px solid rgba(255,255,255,0.14);
            padding: 38px;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 34px;
            align-items: center;
        }

        .waveman-benefits-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.045) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.55;
            pointer-events: none;
        }

        .waveman-benefits-copy,
        .waveman-benefits-visual {
            position: relative;
            z-index: 2;
        }

        .waveman-benefits-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 199, 65, 0.14);
            color: #ffd04f;
            border: 1px solid rgba(255, 199, 65, 0.45);
            border-radius: 999px;
            padding: 10px 17px;
            font-size: 13px;
            font-weight: 950;
            letter-spacing: 0.7px;
            margin-bottom: 18px;
        }

        .waveman-benefits-copy h2 {
            margin: 0;
            font-size: 46px;
            line-height: 1.08;
            letter-spacing: -1.4px;
            font-weight: 950;
        }

        .waveman-benefits-copy h2 span {
            color: #ffd04f;
        }

        .waveman-benefits-copy p {
            margin: 18px 0 24px;
            color: #dce9ff;
            line-height: 1.75;
            font-size: 16.5px;
            font-weight: 650;
            max-width: 590px;
        }

        .waveman-benefits-actions {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .waveman-benefits-primary,
        .waveman-benefits-secondary {
            min-height: 50px;
            padding: 0 24px;
            border-radius: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .waveman-benefits-primary {
            background: #ffd04f;
            color: #071743;
            box-shadow: 0 14px 26px rgba(255, 208, 79, 0.22);
        }

        .waveman-benefits-secondary {
            background: rgba(255,255,255,0.10);
            color: white;
            border: 1px solid rgba(255,255,255,0.24);
        }

        .waveman-benefits-primary:hover,
        .waveman-benefits-secondary:hover {
            transform: translateY(-2px);
        }

        .benefit-photo-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 16px;
            min-height: 520px;
        }

        .benefit-photo {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: #06143d;
            min-height: 220px;
            box-shadow: 0 20px 38px rgba(0,0,0,0.30);
            border: 1px solid rgba(255,255,255,0.18);
        }

        .benefit-photo.tall {
            min-height: 520px;
        }

        .benefit-photo-stack {
            display: grid;
            gap: 16px;
        }

        .benefit-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: saturate(1.08) contrast(1.04);
            transform: scale(1.02);
        }

        .benefit-photo::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, transparent 35%, rgba(2, 8, 23, 0.82) 100%),
                radial-gradient(circle at 80% 15%, rgba(11, 99, 246, 0.20), transparent 25%);
        }

        .photo-badge {
            position: absolute;
            left: 16px;
            right: 16px;
            bottom: 16px;
            z-index: 2;
            background: rgba(2, 8, 23, 0.78);
            border: 1px solid rgba(255,255,255,0.18);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 13px 14px;
        }

        .photo-badge strong {
            display: block;
            color: white;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .photo-badge span {
            display: block;
            color: #dce9ff;
            font-size: 12.5px;
            line-height: 1.35;
            font-weight: 700;
        }

        .floating-feature {
            position: absolute;
            z-index: 3;
            right: 26px;
            top: 26px;
            display: grid;
            gap: 12px;
        }

        .floating-feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.13);
            border: 1px solid rgba(255,255,255,0.20);
            color: white;
            backdrop-filter: blur(9px);
            border-radius: 999px;
            padding: 9px 13px;
            font-size: 12.5px;
            font-weight: 900;
            box-shadow: 0 12px 28px rgba(0,0,0,0.22);
        }

        .floating-feature-item span {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ffd04f;
            color: #06143d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .waveman-benefits-strip {
            margin-top: 18px;
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 13px;
        }

        .waveman-benefits-mini {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.18);
            color: white;
            border-radius: 18px;
            padding: 15px 10px;
            text-align: center;
            font-size: 12.5px;
            font-weight: 900;
            min-height: 92px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 7px;
        }

        .waveman-benefits-mini span {
            font-size: 27px;
        }

        @media (max-width: 1100px) {
            .waveman-benefits-card {
                grid-template-columns: 1fr;
            }

            .benefit-photo-grid {
                min-height: auto;
            }

            .benefit-photo.tall {
                min-height: 420px;
            }

            .waveman-benefits-strip {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 760px) {
            .waveman-benefits-card {
                padding: 24px;
                border-radius: 26px;
            }

            .waveman-benefits-copy h2 {
                font-size: 34px;
            }

            .benefit-photo-grid {
                grid-template-columns: 1fr;
            }

            .benefit-photo.tall {
                min-height: 310px;
            }

            .benefit-photo {
                min-height: 220px;
            }

            .floating-feature {
                position: relative;
                top: auto;
                right: auto;
                margin-bottom: 14px;
            }

            .waveman-benefits-strip {
                grid-template-columns: 1fr;
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
                Start Your Own
                <br>
                <span>Hotspot Internet</span> Business
            </h1>

            <p>
                WaveISP helps you sell Wi-Fi data plans, accept payments,
                manage customers, and connect users automatically through MikroTik HotSpot.
            </p>

            <div class="hero-actions">
                <a href="{{ route('portal.plans') }}" class="primary-btn">
                    📶 View Internet Plans
                </a>

                <a href="{{ route('portal.support') }}" class="outline-btn">
                    🎧 Get Support
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

<div class="separator">
    <div class="separator-lines">
        <div class="separator-line"></div>
        <div class="separator-line small"></div>
    </div>
</div>

<section class="customer-pitch-section">
    <div class="customer-pitch-title">
        <h2>
            Affordable <span>Internet Access</span> for Everyone
        </h2>

        <p>
            WaveISP gives customers simple, fast and pocket-friendly internet access.
            Connect your phone, laptop, shop, office or home devices without stress.
        </p>
    </div>

    <div class="customer-pitch-card">
        <div class="pitch-photos">
            <div class="photo-tile large">
                <img
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80"
                    alt="Customer using laptop with internet access"
                    loading="lazy"
                >
                <div class="photo-label">Fast internet for work and study</div>
            </div>

            <div class="photo-tile">
                <img
                    src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=80"
                    alt="Network equipment and internet infrastructure"
                    loading="lazy"
                >
                <div class="photo-label">Stable Wi-Fi network</div>
            </div>

            <div class="photo-tile">
                <img
                    src="https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=900&q=80"
                    alt="Smart home and connected devices"
                    loading="lazy"
                >
                <div class="photo-label">Home and smart devices</div>
            </div>
        </div>

        <div class="pitch-copy">
            <div class="tag">
                WHY USERS CHOOSE WAVEISP
            </div>

            <h3>
                Buy affordable internet and
                <span>start browsing instantly.</span>
            </h3>

            <p>
                No long process. No waiting for manual activation.
                Simply connect to WaveISP Wi-Fi, choose a plan that fits your pocket,
                pay securely, and enjoy internet access on your phone, laptop,
                smart TV, CCTV, POS device, office computer or home gadgets.
            </p>

            <div class="customer-steps">
                <div class="customer-step">
                    <div class="customer-step-number">1</div>
                    <div>
                        <strong>Connect to WaveISP Wi-Fi</strong>
                        <span>Join the available Wi-Fi network on your phone, laptop or smart device.</span>
                    </div>
                </div>

                <div class="customer-step">
                    <div class="customer-step-number">2</div>
                    <div>
                        <strong>Choose an affordable plan</strong>
                        <span>Select a daily, weekly or monthly package that matches your budget.</span>
                    </div>
                </div>

                <div class="customer-step">
                    <div class="customer-step-number">3</div>
                    <div>
                        <strong>Pay and get connected</strong>
                        <span>After payment, your access is activated and you can start browsing.</span>
                    </div>
                </div>

                <div class="customer-step">
                    <div class="customer-step-number">4</div>
                    <div>
                        <strong>Enjoy reliable support</strong>
                        <span>Need help with payment, login or connection? WaveISP support is ready.</span>
                    </div>
                </div>
            </div>

            <div class="pitch-buttons">
                <a href="{{ route('portal.plans') }}" class="pitch-primary">
                    View Data Plans →
                </a>

                <a href="{{ route('portal.support') }}" class="pitch-secondary">
                    Contact Support
                </a>
            </div>
        </div>
    </div>

    <div class="mini-benefits">
        <div class="mini-benefit">
            <div class="icon">💰</div>
            <h3>Pocket-Friendly Plans</h3>
            <p>Choose from daily, weekly and monthly internet packages that fit your budget.</p>
        </div>

        <div class="mini-benefit">
            <div class="icon">⚡</div>
            <h3>Instant Activation</h3>
            <p>Pay online and get access quickly without waiting for manual setup.</p>
        </div>

        <div class="mini-benefit">
            <div class="icon">📶</div>
            <h3>Connect More Devices</h3>
            <p>Use WaveISP for phones, laptops, smart TVs, CCTV, POS and office devices.</p>
        </div>

        <div class="mini-benefit">
            <div class="icon">🎧</div>
            <h3>Help When Needed</h3>
            <p>Support is available when you need help with login, payment or browsing.</p>
        </div>
    </div>
</section>

<section class="waveman-benefits">
    <div class="waveman-benefits-card">
        <div class="waveman-benefits-copy">
            <div class="waveman-benefits-tag">
                📡 WAVEMAN ISP CUSTOMER BENEFITS
            </div>

            <h2>
                More than internet.
                <br>
                <span>A smarter connected home and business.</span>
            </h2>

            <p>
                With WaveISP, users can enjoy reliable Wi-Fi access, smooth online payment,
                fast activation, better hotspot control, and support for devices like CCTV,
                smart door locks, video doorbells, smart lighting, phones, laptops and office systems.
            </p>

            <div class="waveman-benefits-actions">
                <a href="{{ route('portal.plans') }}" class="waveman-benefits-primary">
                    Buy Internet Plan →
                </a>

                <a href="{{ route('portal.support') }}" class="waveman-benefits-secondary">
                    Talk to Support
                </a>
            </div>

            <div class="waveman-benefits-strip">
                <div class="waveman-benefits-mini">
                    <span>📶</span>
                    Reliable Wi-Fi
                </div>

                <div class="waveman-benefits-mini">
                    <span>💳</span>
                    Easy Payment
                </div>

                <div class="waveman-benefits-mini">
                    <span>🎥</span>
                    CCTV Ready
                </div>

                <div class="waveman-benefits-mini">
                    <span>🔐</span>
                    Smart Locks
                </div>

                <div class="waveman-benefits-mini">
                    <span>💡</span>
                    Smart Lighting
                </div>
            </div>
        </div>

        <div class="waveman-benefits-visual">
            <div class="benefit-photo-grid">
                <div class="benefit-photo tall">
                    <img
                        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85"
                        alt="Modern connected home using reliable internet"
                        loading="lazy"
                    >

                    <div class="photo-badge">
                        <strong>Connected Home & Business</strong>
                        <span>Stable internet for browsing, work, smart devices and entertainment.</span>
                    </div>
                </div>

                <div class="benefit-photo-stack">
                    <div class="benefit-photo">
                        <img
                            src="https://images.unsplash.com/photo-1558002038-1055907df827?auto=format&fit=crop&w=900&q=85"
                            alt="Smart home devices connected to Wi-Fi"
                            loading="lazy"
                        >

                        <div class="photo-badge">
                            <strong>Smart Devices</strong>
                            <span>CCTV, smart lighting, video doorbells and access systems.</span>
                        </div>
                    </div>

                    <div class="benefit-photo">
                        <img
                            src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=85"
                            alt="Laptop user enjoying internet access"
                            loading="lazy"
                        >

                        <div class="photo-badge">
                            <strong>Work, Study & Browse</strong>
                            <span>Affordable plans for phones, laptops, shops, offices and homes.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cta-band">
    <div class="cta-inner">
        <div>
            <h3>Ready to buy internet access?</h3>
            <p>View available WaveISP data plans and connect instantly.</p>
        </div>

        <a href="{{ route('portal.plans') }}">
            View Plans →
        </a>
    </div>
</section>

<footer class="footer-pro">
    <div class="footer-pro-inner">
        <div class="footer-brand">
            <strong>Wave<span>ISP</span></strong>
            <p>
                Connect. Surf. Live. A smart hotspot billing system for homes,
                businesses, estates, schools, lounges and communities.
            </p>
        </div>

        <div>
            <h4>Quick Links</h4>
            <a href="{{ route('portal.home') }}">Home</a>
            <a href="{{ route('portal.plans') }}">Internet Plans</a>
            <a href="{{ route('portal.support') }}">Support</a>
            <a href="/admin/login">Admin Login</a>
        </div>

        <div>
            <h4>Services</h4>
            <a href="{{ route('portal.plans') }}">Hotspot Internet</a>
            <a href="{{ route('portal.support') }}">Customer Support</a>
            <a href="{{ route('portal.support') }}">Wi-Fi Setup Help</a>
            <a href="{{ route('portal.support') }}">Smart Device Internet</a>
        </div>

        <div>
            <h4>Contact</h4>
            <div class="footer-contact-box">
                <p>📞 +234 813 696 3037</p>
                <p>💬 WhatsApp Support Available</p>
                <p>📍 Port Harcourt, Rivers State</p>
                <p>🌐 WaveISP by Waveman</p>
            </div>
        </div>
    </div>

    <div class="footer-copy">
        © 2026 WaveISP. CONNECTING HOMES • POWERING BUSINESS • DELIVERING RELIABLE INTERNET.
    </div>
</footer>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internet Activated - WaveISP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            background:
                radial-gradient(circle at 80% 10%, rgba(11, 99, 246, .18), transparent 24%),
                #f4f7fb;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #06143d;
            padding: 24px;
        }

        .wrap {
            max-width: 820px;
            margin: 40px auto;
        }

        .card {
            background: white;
            border-radius: 26px;
            padding: 34px;
            box-shadow: 0 18px 42px rgba(4,33,91,.12);
            border: 1px solid #dfe7f5;
        }

        .badge {
            display: inline-flex;
            background: #dcfce7;
            color: #166534;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 950;
            margin-bottom: 18px;
        }

        .badge-error {
            background: #fee2e2;
            color: #991b1b;
        }

        h1 {
            margin: 0 0 10px;
            font-size: 34px;
        }

        p {
            color: #475569;
            font-weight: 650;
            line-height: 1.6;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin: 16px 0;
            font-weight: 850;
            line-height: 1.5;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .details {
            background: #f8fafc;
            border-radius: 18px;
            padding: 18px;
            margin: 22px 0;
            border: 1px solid #e2e8f0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .row:last-child {
            border-bottom: 0;
        }

        .row strong {
            color: #06143d;
        }

        .row span {
            color: #334155;
            font-weight: 800;
            text-align: right;
        }

        .access-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin: 22px 0;
        }

        .access-item {
            background: #061b51;
            color: white;
            border-radius: 18px;
            padding: 18px;
        }

        .access-item small {
            display: block;
            color: #bfd7ff;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .access-item strong {
            display: block;
            font-size: 22px;
            letter-spacing: 1px;
        }

        .btn {
            min-height: 52px;
            border-radius: 13px;
            padding: 0 22px;
            background: #0b63f6;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            margin-right: 10px;
            margin-top: 10px;
        }

        .btn-light {
            background: #eaf3ff;
            color: #0b63f6;
        }

        @media(max-width: 700px) {
            .access-box {
                grid-template-columns: 1fr;
            }

            .row {
                flex-direction: column;
            }

            .row span {
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="card">
        @if($payment->customer?->mikrotik_created)
            <div class="badge">Internet Activated</div>
            <h1>Your WaveISP Access Is Ready</h1>
            <p>
                Your payment is successful and your HotSpot user has been created on MikroTik.
                Connect to the Wi-Fi and use your access details below.
            </p>
        @else
            <div class="badge badge-error">Activation Needs Attention</div>
            <h1>Payment Saved, MikroTik Sync Not Complete</h1>
            <p>
                Your payment/customer record exists, but MikroTik user creation did not complete.
                Contact support or test the router connection from admin.
            </p>
        @endif

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif

        @if($payment->customer?->mikrotik_error)
            <div class="alert error">
                {{ $payment->customer->mikrotik_error }}
            </div>
        @endif

        <div class="access-box">
            <div class="access-item">
                <small>Username</small>
                <strong>{{ $payment->customer?->username ?? '-' }}</strong>
            </div>

            <div class="access-item">
                <small>Password</small>
                <strong>{{ $payment->customer?->password ?? '-' }}</strong>
            </div>
        </div>

        <div class="details">
            <div class="row">
                <strong>Plan</strong>
                <span>{{ $payment->plan?->name ?? '-' }}</span>
            </div>

            <div class="row">
                <strong>Amount</strong>
                <span>₦{{ number_format($payment->amount, 0) }}</span>
            </div>

            <div class="row">
                <strong>Payment Status</strong>
                <span>{{ ucfirst($payment->status) }}</span>
            </div>

            <div class="row">
                <strong>Expires At</strong>
                <span>{{ $payment->customer?->expires_at?->format('d M Y, h:i A') ?? '-' }}</span>
            </div>

            <div class="row">
                <strong>MikroTik Status</strong>
                <span>{{ $payment->customer?->mikrotik_created ? 'Created' : 'Not Created' }}</span>
            </div>
        </div>

        <a href="{{ route('portal.plans') }}" class="btn">
            Buy Another Plan
        </a>

        <a href="{{ route('portal.support') }}" class="btn btn-light">
            Contact Support
        </a>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Pending - WaveISP</title>
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
            max-width: 760px;
            margin: 40px auto;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 18px 42px rgba(4,33,91,.12);
            border: 1px solid #dfe7f5;
        }

        .badge {
            display: inline-flex;
            background: #fff7ed;
            color: #c2410c;
            border-radius: 999px;
            padding: 8px 14px;
            font-weight: 900;
            margin-bottom: 18px;
        }

        h1 {
            margin: 0 0 10px;
            font-size: 32px;
        }

        p {
            color: #475569;
            font-weight: 650;
            line-height: 1.6;
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
            font-weight: 750;
            text-align: right;
        }

        .btn {
            width: 100%;
            min-height: 52px;
            border: 0;
            border-radius: 13px;
            background: #0b63f6;
            color: white;
            font-size: 16px;
            font-weight: 950;
            cursor: pointer;
            margin-top: 12px;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-light {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf3ff;
            color: #0b63f6;
            text-decoration: none;
        }

        .notice {
            background: #eff6ff;
            color: #1e3a8a;
            padding: 14px;
            border-radius: 14px;
            font-weight: 750;
            line-height: 1.6;
            margin-top: 16px;
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body>

<div class="wrap">
    <div class="card">
        <div class="badge">Payment Pending</div>

        <h1>Complete Your Internet Activation</h1>

        <p>
            Your order has been created. The next step is real Paystack payment.
            For local testing, use the test activation button below to mark the payment successful
            and create the customer voucher on MikroTik.
        </p>

        <div class="details">
            <div class="row">
                <strong>Plan</strong>
                <span>{{ $plan->name }}</span>
            </div>

            <div class="row">
                <strong>Amount</strong>
                <span>₦{{ number_format($payment->amount, 0) }}</span>
            </div>

            <div class="row">
                <strong>Reference</strong>
                <span>{{ $payment->reference }}</span>
            </div>

            <div class="row">
                <strong>Customer</strong>
                <span>{{ $customer->full_name }}</span>
            </div>

            <div class="row">
                <strong>Phone</strong>
                <span>{{ $customer->phone }}</span>
            </div>

            <div class="row">
                <strong>Voucher Password</strong>
                <span>{{ $customer->password }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('payment.testActivate', $payment) }}">
            @csrf
            <button type="submit" class="btn btn-green">
                Local Test: Mark Paid & Create MikroTik Voucher
            </button>
        </form>

        <a href="{{ route('portal.plans') }}" class="btn btn-light">
            Choose Another Plan
        </a>

        <div class="notice">
            Before clicking test activation, make sure you have added your router under
            Admin → Routers and the MikroTik connection test is successful.
        </div>
    </div>
</div>

</body>
</html>
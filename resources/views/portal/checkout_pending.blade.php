<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Pending - WaveISP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;min-height:100vh;background:#f4f7fb;font-family:Arial;color:#06143d;display:flex;align-items:center;justify-content:center;padding:24px;">

<div style="width:100%;max-width:560px;background:white;border-radius:24px;padding:32px;box-shadow:0 18px 45px rgba(4,33,91,.14);text-align:center;">
    <div style="width:78px;height:78px;border-radius:50%;background:#eff6ff;color:#0b63f6;display:flex;align-items:center;justify-content:center;font-size:38px;margin:0 auto 18px;">
        💳
    </div>

    <h1>Checkout Created</h1>

    <p style="color:#475569;line-height:1.6;">
        Your customer record and pending payment reference have been created.
        Next we will connect this page to Paystack for real payment.
    </p>

    <div style="background:#f8fafc;border-radius:16px;padding:18px;margin:20px 0;text-align:left;line-height:1.9;font-weight:bold;">
        <div>Name: {{ $customer->full_name }}</div>
        <div>Phone: {{ $customer->phone }}</div>
        <div>Plan: {{ $plan->name }}</div>
        <div>Amount: ₦{{ number_format($payment->amount, 0) }}</div>
        <div>Reference: {{ $payment->reference }}</div>
        <div>Access Code: {{ $customer->username }}</div>
    </div>

    <a href="{{ route('portal.home') }}#plans" style="display:block;background:#0b63f6;color:white;border-radius:12px;padding:15px;text-decoration:none;font-weight:bold;">
        Back to Plans
    </a>
</div>

</body>
</html>
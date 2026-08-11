<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'WaveISP Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f7fb;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #06143d;
        }

        a { text-decoration: none; }

        .header {
            background:
                radial-gradient(circle at 80% 20%, rgba(11, 99, 246, .25), transparent 24%),
                linear-gradient(135deg, #020817, #061b51);
            color: white;
            padding: 24px;
        }

        .header-inner {
            max-width: 1320px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .brand h1 {
            margin: 0;
            font-size: 28px;
        }

        .brand p {
            margin: 6px 0 0;
            color: #dbe8ff;
            font-weight: 650;
        }

        .nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav a,
        .nav button {
            background: rgba(255,255,255,.12);
            color: white;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 11px;
            padding: 10px 14px;
            font-weight: 900;
            cursor: pointer;
        }

        .wrap {
            max-width: 1320px;
            margin: 28px auto;
            padding: 0 24px 44px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 16px;
            font-weight: 850;
        }

        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }

        .admin-actions {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .admin-action {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 12px 28px rgba(4,33,91,.08);
            color: #06143d;
            font-weight: 950;
        }

        .admin-action span {
            display: block;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .admin-action small {
            display: block;
            color: #64748b;
            font-weight: 700;
            margin-top: 4px;
        }

        .card {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 22px;
            box-shadow: 0 14px 34px rgba(4,33,91,.09);
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-head {
            padding: 20px 22px;
            border-bottom: 1px solid #e5eaf5;
            background: #f8fafc;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .card-head h2 {
            margin: 0;
            font-size: 22px;
        }

        .card-body {
            padding: 22px;
        }

        .btn,
        button.btn {
            background: #0b63f6;
            color: white;
            border: 0;
            border-radius: 12px;
            padding: 11px 16px;
            font-weight: 950;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .btn-green { background: #16a34a; }
        .btn-red { background: #dc2626; }
        .btn-gray { background: #64748b; }
        .btn-orange { background: #f97316; }
        .btn-light { background: #eaf3ff; color: #0b63f6; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 12px 28px rgba(4,33,91,.08);
        }

        .stat strong {
            display: block;
            color: #0b63f6;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .stat span {
            color: #64748b;
            font-weight: 850;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #e5eaf5;
            text-align: left;
            vertical-align: top;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            text-transform: uppercase;
            font-size: 12px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        .badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 950;
        }

        .active, .successful, .completed { background: #dcfce7; color: #166534; }
        .pending, .processing { background: #fef3c7; color: #92400e; }
        .failed, .suspended, .inactive { background: #fee2e2; color: #991b1b; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: 900;
            margin-bottom: 7px;
        }

        input,
        select {
            width: 100%;
            height: 48px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 0 14px;
            font-size: 15px;
            background: #fbfdff;
        }

        .error-text {
            color: #dc2626;
            font-size: 13px;
            font-weight: 800;
            margin-top: 5px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        @media(max-width: 1050px) {
            .admin-actions,
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-inner,
            .card-head {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media(max-width: 700px) {
            .admin-actions,
            .stats-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div class="brand">
            <h1>WaveISP Admin</h1>
            <p>@yield('subtitle', 'Cloud HotSpot billing control panel')</p>
        </div>

        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.statistics') }}">Statistics</a>
            <a href="{{ route('admin.plans.index') }}">Plans</a>
            <a href="{{ route('admin.customers.index') }}">Users</a>
            <a href="{{ route('admin.routers.index') }}">Routers</a>
            <a href="{{ route('admin.vpn.index') }}">VPN</a>
            <a href="{{ route('admin.settings.index') }}">Settings</a>
            <a href="{{ route('portal.home') }}">Site</a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>

<main class="wrap">
    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <div class="admin-actions">
        <a class="admin-action" href="{{ route('admin.dashboard') }}">
            <span>🏠</span> Dashboard
            <small>Admin overview</small>
        </a>

        <a class="admin-action" href="{{ route('admin.statistics') }}">
            <span>📊</span> Statistics
            <small>Revenue and activity</small>
        </a>

        <a class="admin-action" href="{{ route('admin.plans.index') }}">
            <span>📦</span> Plans
            <small>Add or remove plans</small>
        </a>

        <a class="admin-action" href="{{ route('admin.customers.index') }}">
            <span>👥</span> Users
            <small>Customers and vouchers</small>
        </a>

        <a class="admin-action" href="{{ route('admin.routers.index') }}">
            <span>📡</span> Routers
            <small>MikroTik and agent</small>
        </a>

        <a class="admin-action" href="{{ route('admin.vpn.index') }}">
            <span>🔐</span> VPN
            <small>WireGuard guide</small>
        </a>
    </div>

    @yield('content')
</main>

</body>
</html>
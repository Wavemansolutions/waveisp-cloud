<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Routers - WaveISP Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            background: #f4f7fb;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #06143d;
        }

        a {
            text-decoration: none;
        }

        .header {
            background: #061b51;
            color: white;
            padding: 22px 30px;
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .nav {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav a,
        .nav button {
            background: rgba(255,255,255,.12);
            color: white;
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .wrap {
            max-width: 1280px;
            margin: 28px auto;
            padding: 0 24px;
        }

        .top-actions {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 18px;
        }

        .btn {
            background: #0b63f6;
            color: white;
            border: 0;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 900;
            cursor: pointer;
            display: inline-flex;
        }

        .btn-red {
            background: #dc2626;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-gray {
            background: #64748b;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 16px;
            font-weight: 800;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 14px 34px rgba(4,33,91,.10);
            overflow: hidden;
            border: 1px solid #dfe7f5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px;
            border-bottom: 1px solid #e5eaf5;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            font-size: 13px;
            text-transform: uppercase;
            color: #475569;
        }

        td {
            font-size: 14px;
            font-weight: 650;
        }

        .status {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        pre {
            white-space: pre-wrap;
            background: #020817;
            color: #dbeafe;
            border-radius: 16px;
            padding: 18px;
            overflow: auto;
        }

        @media(max-width: 850px) {
            table {
                min-width: 900px;
            }

            .card {
                overflow-x: auto;
            }

            .header-inner,
            .top-actions {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div>
            <h1>WaveISP Routers</h1>
            <div>MikroTik VPN/API management</div>
        </div>

        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.routers.index') }}">Routers</a>
            <a href="{{ route('portal.home') }}">View Site</a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</header>

<main class="wrap">
    <div class="top-actions">
        <div>
            <h2 style="margin:0;">MikroTik Routers</h2>
            <p style="margin:5px 0 0;color:#64748b;font-weight:700;">
                Add your VPN/private MikroTik IP and API credentials.
            </p>
        </div>

        <a href="{{ route('admin.routers.create') }}" class="btn">
            + Add Router
        </a>
    </div>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if(session('mikrotik_data'))
        <pre>{{ json_encode(session('mikrotik_data'), JSON_PRETTY_PRINT) }}</pre>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>VPN/API IP</th>
                    <th>API Port</th>
                    <th>Username</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>SSL</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($routers as $router)
                    <tr>
                        <td>{{ $router->name }}</td>
                        <td>{{ $router->ip_address }}</td>
                        <td>{{ $router->api_port }}</td>
                        <td>{{ $router->username }}</td>
                        <td>{{ $router->location ?? '-' }}</td>
                        <td>
                            <span class="status {{ $router->is_active ? 'active' : 'inactive' }}">
                                {{ $router->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>{{ $router->api_ssl ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="actions">
                                <form method="POST" action="{{ route('admin.routers.test', $router) }}">
                                    @csrf
                                    <button class="btn btn-green" type="submit">Test</button>
                                </form>

                                <a href="{{ route('admin.routers.edit', $router) }}" class="btn btn-gray">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('admin.routers.destroy', $router) }}" onsubmit="return confirm('Delete this router?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-red" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            No router added yet. Click Add Router to add your MikroTik VPN/API details.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
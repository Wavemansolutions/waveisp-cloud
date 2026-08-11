<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Router Agent - WaveISP Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <style>
        body {
            margin: 0;
            background: #f4f7fb;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #06143d;
        }

        a { text-decoration: none; }

        .header {
            background: linear-gradient(135deg, #020817, #061b51);
            color: white;
            padding: 24px;
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .header p {
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
            max-width: 1280px;
            margin: 28px auto;
            padding: 0 24px 44px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 16px;
            font-weight: 850;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .card {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 24px;
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
            gap: 14px;
            align-items: center;
        }

        .card-head h2 {
            margin: 0;
            font-size: 22px;
        }

        .card-body {
            padding: 22px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 18px;
        }

        .stat strong {
            display: block;
            font-size: 28px;
            color: #0b63f6;
        }

        .stat span {
            color: #64748b;
            font-weight: 800;
            font-size: 13px;
        }

        .grid {
            display: grid;
            grid-template-columns: .85fr 1.15fr;
            gap: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #e5eaf5;
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-row strong {
            color: #06143d;
        }

        .info-row span {
            color: #475569;
            font-weight: 800;
            text-align: right;
            word-break: break-all;
        }

        pre {
            background: #020817;
            color: #dbeafe;
            border-radius: 18px;
            padding: 18px;
            overflow-x: auto;
            line-height: 1.55;
            font-size: 13px;
            white-space: pre-wrap;
            margin: 0;
        }

        .code-title {
            margin: 22px 0 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .code-title strong {
            font-size: 16px;
        }

        .hint {
            background: #eff6ff;
            color: #1e3a8a;
            border-radius: 16px;
            padding: 15px;
            font-weight: 750;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .warning {
            background: #fff7ed;
            color: #9a3412;
            border-radius: 16px;
            padding: 15px;
            font-weight: 750;
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .btn {
            background: #0b63f6;
            color: white;
            border: 0;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 950;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-red {
            background: #dc2626;
        }

        .btn-gray {
            background: #64748b;
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

        .badge {
            display: inline-flex;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 950;
        }

        .pending { background: #fef3c7; color: #92400e; }
        .processing { background: #dbeafe; color: #1d4ed8; }
        .completed { background: #dcfce7; color: #166534; }
        .failed { background: #fee2e2; color: #991b1b; }

        @media(max-width: 950px) {
            .header-inner,
            .card-head {
                flex-direction: column;
                align-items: flex-start;
            }

            .grid,
            .stats {
                grid-template-columns: 1fr;
            }

            .info-row {
                flex-direction: column;
            }

            .info-row span {
                text-align: left;
            }

            table {
                min-width: 900px;
            }

            .table-wrap {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div>
            <h1>Router Agent Center</h1>
            <p>{{ $router->name }} — Railway cloud agent commands for MikroTik.</p>
        </div>

        <div class="nav">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.routers.index') }}">Routers</a>
            <a href="{{ route('admin.vpn.index') }}">VPN Setup</a>
            <a href="{{ route('portal.home') }}">View Site</a>

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

    <div class="stats">
        <div class="stat">
            <strong>{{ $router->pending_jobs_count }}</strong>
            <span>Pending Jobs</span>
        </div>

        <div class="stat">
            <strong>{{ $router->processing_jobs_count }}</strong>
            <span>Processing Jobs</span>
        </div>

        <div class="stat">
            <strong>{{ $router->completed_jobs_count }}</strong>
            <span>Completed Jobs</span>
        </div>

        <div class="stat">
            <strong>{{ $router->failed_jobs_count }}</strong>
            <span>Failed Jobs</span>
        </div>
    </div>

    <section class="card">
        <div class="card-head">
            <h2>Agent Details</h2>

            <form method="POST" action="{{ route('admin.routers.regenerateAgentToken', $router) }}" onsubmit="return confirm('Regenerate token? Old MikroTik script will stop working until updated.')">
                @csrf
                <button class="btn btn-red" type="submit">Regenerate Token</button>
            </form>
        </div>

        <div class="card-body">
            <div class="grid">
                <div>
                    <div class="info-row">
                        <strong>Router Name</strong>
                        <span>{{ $router->name }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Sync Mode</strong>
                        <span>{{ $router->sync_mode ?? 'agent' }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Agent Token</strong>
                        <span>{{ $router->agent_token }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Last Seen</strong>
                        <span>{{ $router->last_seen_at?->format('d M Y, h:i A') ?? 'Not seen yet' }}</span>
                    </div>

                    <div class="info-row">
                        <strong>Local Agent URL</strong>
                        <span>{{ $agentUrl }}</span>
                    </div>
                </div>

                <div>
                    <div class="hint">
                        For Railway production, replace your local domain with your Railway app domain.
                        Example: <strong>https://your-app.up.railway.app</strong>
                    </div>

                    <div class="warning">
                        Keep your agent token private. Anyone with this URL can collect router jobs.
                    </div>
                </div>
            </div>

            <div class="code-title">
                <strong>Manual RouterOS command</strong>
            </div>

<pre>/tool fetch url="{{ $agentUrl }}" dst-path=waveisp-agent.rsc
/import file-name=waveisp-agent.rsc</pre>

            <div class="code-title">
                <strong>RouterOS scheduler script</strong>
            </div>

<pre>/system script add name=waveisp-agent source={/tool fetch url="{{ $agentUrl }}" dst-path=waveisp-agent.rsc; /import file-name=waveisp-agent.rsc}

/system scheduler add name=waveisp-agent interval=30s on-event="/system script run waveisp-agent" policy=read,write,policy,test,password,sensitive</pre>

            <div class="code-title">
                <strong>Production Railway scheduler script</strong>
            </div>

<pre># Replace YOUR-RAILWAY-DOMAIN with your real Railway domain first.

/system script add name=waveisp-agent source={/tool fetch url="https://YOUR-RAILWAY-DOMAIN.up.railway.app/agent/routers/{{ $router->id }}/script?token={{ $router->agent_token }}" dst-path=waveisp-agent.rsc; /import file-name=waveisp-agent.rsc}

/system scheduler add name=waveisp-agent interval=30s on-event="/system script run waveisp-agent" policy=read,write,policy,test,password,sensitive</pre>
        </div>
    </section>

    <section class="card">
        <div class="card-head">
            <h2>Recent Router Jobs</h2>
            <a href="{{ route('admin.routers.agent', $router) }}" class="btn btn-gray">Refresh</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Job Type</th>
                        <th>Status</th>
                        <th>Attempts</th>
                        <th>Payload</th>
                        <th>Result</th>
                        <th>Created</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>
                                {{ $job->customer?->full_name ?? '-' }}<br>
                                <small>{{ $job->customer?->phone ?? '' }}</small>
                            </td>
                            <td>{{ $job->job_type }}</td>
                            <td>
                                <span class="badge {{ $job->status }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td>{{ $job->attempts }}</td>
                            <td>
                                <pre style="max-height:160px;">{{ json_encode($job->payload, JSON_PRETTY_PRINT) }}</pre>
                            </td>
                            <td>{{ $job->result ?? '-' }}</td>
                            <td>{{ $job->created_at?->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No router jobs yet. A job will appear after a successful payment is queued.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

</body>
</html>
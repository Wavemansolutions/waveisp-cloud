<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WireGuard VPN Setup - WaveISP Admin</title>
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
                radial-gradient(circle at 80% 20%, rgba(11, 99, 246, .28), transparent 24%),
                linear-gradient(135deg, #020817, #061b51);
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

        .hero-card {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 26px;
            padding: 28px;
            box-shadow: 0 18px 42px rgba(4,33,91,.10);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: center;
            margin-bottom: 24px;
        }

        .hero-card h2 {
            margin: 0;
            font-size: 34px;
            line-height: 1.15;
        }

        .hero-card h2 span {
            color: #0b63f6;
        }

        .hero-card p {
            color: #475569;
            line-height: 1.7;
            font-weight: 650;
        }

        .diagram {
            background:
                radial-gradient(circle at 80% 20%, rgba(255, 208, 79, .22), transparent 22%),
                linear-gradient(135deg, #020817, #061b51 55%, #003fbd);
            color: white;
            border-radius: 24px;
            min-height: 310px;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .diagram::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: .5;
        }

        .diagram-inner {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 70px 1fr;
            gap: 16px;
            align-items: center;
            height: 100%;
            min-height: 250px;
        }

        .node {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 20px;
            padding: 18px;
            text-align: center;
        }

        .node .icon {
            font-size: 38px;
            margin-bottom: 10px;
        }

        .node strong {
            display: block;
            font-size: 17px;
        }

        .node span {
            display: block;
            color: #dbe8ff;
            font-size: 13px;
            line-height: 1.4;
            margin-top: 6px;
            font-weight: 700;
        }

        .tunnel {
            height: 70px;
            border-radius: 999px;
            border: 2px dashed rgba(255,255,255,.45);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffd04f;
            font-weight: 950;
        }

        .notice {
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
            border-radius: 18px;
            padding: 16px;
            line-height: 1.6;
            font-weight: 750;
            margin-bottom: 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .card {
            background: white;
            border: 1px solid #dfe7f5;
            border-radius: 24px;
            box-shadow: 0 14px 34px rgba(4,33,91,.09);
            overflow: hidden;
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

        .card-head h3 {
            margin: 0;
            font-size: 22px;
        }

        .badge {
            display: inline-flex;
            background: #eaf3ff;
            color: #0b63f6;
            border-radius: 999px;
            padding: 8px 13px;
            font-size: 12px;
            font-weight: 950;
            white-space: nowrap;
        }

        .card-body {
            padding: 22px;
        }

        .steps {
            display: grid;
            gap: 12px;
            margin-bottom: 18px;
        }

        .step {
            display: flex;
            gap: 12px;
            background: #f6f9ff;
            border: 1px solid #e1eafa;
            border-radius: 15px;
            padding: 14px;
        }

        .num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0b63f6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 950;
            flex: 0 0 auto;
        }

        .step strong {
            display: block;
            margin-bottom: 3px;
        }

        .step span {
            color: #475569;
            font-size: 14px;
            font-weight: 650;
            line-height: 1.45;
        }

        pre {
            margin: 0;
            background: #020817;
            color: #dbeafe;
            border-radius: 18px;
            padding: 18px;
            overflow-x: auto;
            line-height: 1.55;
            font-size: 13px;
            white-space: pre-wrap;
        }

        .code-title {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin: 18px 0 10px;
        }

        .code-title strong {
            font-size: 15px;
        }

        .small {
            color: #64748b;
            font-size: 13px;
            font-weight: 750;
        }

        .warning {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 14px;
            padding: 14px;
            font-weight: 800;
            line-height: 1.55;
            margin-top: 14px;
        }

        @media(max-width: 950px) {
            .hero-card {
                grid-template-columns: 1fr;
            }

            .diagram-inner {
                grid-template-columns: 1fr;
            }

            .tunnel {
                height: auto;
                padding: 14px;
            }

            .header-inner,
            .card-head {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="header-inner">
        <div>
            <h1>WireGuard VPN Setup</h1>
            <p>Connect WaveISP Cloud Billing to your MikroTik router securely.</p>
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
    <section class="hero-card">
        <div>
            <h2>
                Cloud Billing talks to MikroTik through
                <span>WireGuard VPN.</span>
            </h2>

            <p>
                Your Laravel billing app creates vouchers, activates payments, and controls HotSpot users.
                The VPN makes the router API reachable using a private IP like <strong>10.10.10.2</strong>,
                instead of exposing MikroTik directly to the public internet.
            </p>
        </div>

        <div class="diagram">
            <div class="diagram-inner">
                <div class="node">
                    <div class="icon">☁️</div>
                    <strong>WaveISP Server</strong>
                    <span>Laravel + Paystack + Admin<br>VPN IP: 10.10.10.1</span>
                </div>

                <div class="tunnel">VPN</div>

                <div class="node">
                    <div class="icon">📡</div>
                    <strong>MikroTik Router</strong>
                    <span>RouterOS API + HotSpot<br>VPN IP: 10.10.10.2</span>
                </div>
            </div>
        </div>
    </section>

    <div class="notice">
        Since your MikroTik is offline, do not test sync now. Build the VPN page first, then when the router is online,
        configure WireGuard, enable RouterOS API, add router details in Admin → Routers, and click Test.
    </div>

    <div class="grid">
        <section class="card">
            <div class="card-head">
                <h3>Option A: Cloud VPS WireGuard Server</h3>
                <div class="badge">Recommended for production</div>
            </div>

            <div class="card-body">
                <div class="steps">
                    <div class="step">
                        <div class="num">1</div>
                        <div>
                            <strong>Use a small VPS as VPN gateway</strong>
                            <span>Oracle, Hetzner, DigitalOcean, AWS Lightsail, or any Ubuntu VPS with public IP.</span>
                        </div>
                    </div>

                    <div class="step">
                        <div class="num">2</div>
                        <div>
                            <strong>Run WaveISP where VPN is reachable</strong>
                            <span>Best is to run Laravel on the same VPS or another server that can reach 10.10.10.2.</span>
                        </div>
                    </div>

                    <div class="step">
                        <div class="num">3</div>
                        <div>
                            <strong>MikroTik connects outward to the VPS</strong>
                            <span>This works well even when MikroTik is behind NAT, if internet is available.</span>
                        </div>
                    </div>
                </div>

                <div class="code-title">
                    <strong>Ubuntu VPS commands</strong>
                    <span class="small">Run as root or with sudo</span>
                </div>

<pre>apt update
apt install wireguard -y

mkdir -p /etc/wireguard
cd /etc/wireguard

wg genkey | tee server_private.key | wg pubkey > server_public.key
cat server_private.key
cat server_public.key</pre>

                <div class="code-title">
                    <strong>Create `/etc/wireguard/wg0.conf` on VPS</strong>
                    <span class="small">Replace keys before starting</span>
                </div>

<pre>[Interface]
Address = 10.10.10.1/24
ListenPort = 51820
PrivateKey = SERVER_PRIVATE_KEY

# MikroTik Router Peer
[Peer]
PublicKey = MIKROTIK_PUBLIC_KEY
AllowedIPs = 10.10.10.2/32
PersistentKeepalive = 25</pre>

                <div class="code-title">
                    <strong>Start WireGuard on VPS</strong>
                    <span class="small">Open UDP 51820 in VPS firewall/security list</span>
                </div>

<pre>systemctl enable wg-quick@wg0
systemctl start wg-quick@wg0

wg show
ping 10.10.10.2</pre>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h3>MikroTik RouterOS WireGuard Setup</h3>
                <div class="badge">Run on MikroTik terminal</div>
            </div>

            <div class="card-body">
                <div class="code-title">
                    <strong>Create WireGuard interface and VPN IP</strong>
                    <span class="small">Router VPN IP: 10.10.10.2</span>
                </div>

<pre>/interface/wireguard add name=wg-waveisp listen-port=51820 mtu=1420
/ip/address add address=10.10.10.2/24 interface=wg-waveisp comment="WaveISP VPN IP"

/interface/wireguard print detail</pre>

                <div class="warning">
                    Copy the MikroTik public key from `/interface/wireguard print detail`.
                    Paste it into the VPS `wg0.conf` as `MIKROTIK_PUBLIC_KEY`.
                </div>

                <div class="code-title">
                    <strong>Add VPS as WireGuard peer on MikroTik</strong>
                    <span class="small">Replace SERVER_PUBLIC_KEY and VPS_PUBLIC_IP</span>
                </div>

<pre>/interface/wireguard/peers add interface=wg-waveisp public-key="SERVER_PUBLIC_KEY" endpoint-address=VPS_PUBLIC_IP endpoint-port=51820 allowed-address=10.10.10.1/32 persistent-keepalive=25s comment="WaveISP Cloud VPS"</pre>

                <div class="code-title">
                    <strong>Allow WireGuard and API safely</strong>
                    <span class="small">Restrict API to VPN subnet only</span>
                </div>

<pre>/ip/service enable api
/ip/service set api port=8728 address=10.10.10.0/24

/ip/firewall/filter add chain=input action=accept protocol=udp dst-port=51820 comment="Allow WireGuard VPN"
/ip/firewall/filter add chain=input action=accept protocol=tcp src-address=10.10.10.0/24 dst-port=8728 comment="Allow WaveISP API via VPN"

/ip/firewall/filter print where comment~"WaveISP"</pre>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h3>Option B: Windows Local Testing</h3>
                <div class="badge">For your PC while developing</div>
            </div>

            <div class="card-body">
                <p class="small">
                    Use this only for local testing. Install WireGuard for Windows, create a tunnel,
                    and make your PC the VPN peer with IP <strong>10.10.10.1</strong>.
                </p>

                <div class="code-title">
                    <strong>Windows WireGuard client config</strong>
                    <span class="small">Import into WireGuard Windows app</span>
                </div>

<pre>[Interface]
PrivateKey = WINDOWS_PRIVATE_KEY
Address = 10.10.10.1/24

[Peer]
PublicKey = MIKROTIK_PUBLIC_KEY
AllowedIPs = 10.10.10.2/32
Endpoint = MIKROTIK_PUBLIC_IP_OR_DDNS:51820
PersistentKeepalive = 25</pre>

                <div class="code-title">
                    <strong>PowerShell tests after tunnel is up</strong>
                    <span class="small">Run on Windows</span>
                </div>

<pre>ping 10.10.10.2
Test-NetConnection 10.10.10.2 -Port 8728</pre>
            </div>
        </section>

        <section class="card">
            <div class="card-head">
                <h3>WaveISP Laravel Settings</h3>
                <div class="badge">Admin → Routers</div>
            </div>

            <div class="card-body">
                <div class="steps">
                    <div class="step">
                        <div class="num">1</div>
                        <div>
                            <strong>Add Router</strong>
                            <span>Go to Admin → Routers → Add Router.</span>
                        </div>
                    </div>

                    <div class="step">
                        <div class="num">2</div>
                        <div>
                            <strong>Use VPN IP</strong>
                            <span>Set VPN/API IP Address to <strong>10.10.10.2</strong>, API port <strong>8728</strong>, SSL unchecked.</span>
                        </div>
                    </div>

                    <div class="step">
                        <div class="num">3</div>
                        <div>
                            <strong>Test Router</strong>
                            <span>When MikroTik is online, click Test. Then Retry MikroTik Sync on old successful payments.</span>
                        </div>
                    </div>
                </div>

                <div class="code-title">
                    <strong>Expected Laravel router details</strong>
                    <span class="small">Use this in Admin → Routers</span>
                </div>

<pre>Router Name: RB4011
VPN/API IP: 10.10.10.2
API Port: 8728
Username: waveisp
Password: your MikroTik API password
SSL: unchecked
Active: checked
Location: Garrison</pre>

                <div class="code-title">
                    <strong>Final Laravel test</strong>
                    <span class="small">Run after VPN + router API works</span>
                </div>

<pre>php artisan optimize:clear
php artisan view:clear
php artisan serve

# Browser:
http://127.0.0.1:8000/admin/routers</pre>
            </div>
        </section>
    </div>
</main>

</body>
</html>
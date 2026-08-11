<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Router - WaveISP</title>
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
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 14px 34px rgba(4,33,91,.10);
            border: 1px solid #dfe7f5;
        }

        a {
            text-decoration: none;
            color: #0b63f6;
            font-weight: 900;
        }

        h1 {
            margin-top: 14px;
        }

        label {
            display: block;
            font-weight: 900;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            height: 48px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 0 14px;
            font-size: 15px;
        }

        .field {
            margin-bottom: 16px;
        }

        .check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 12px 0;
            font-weight: 800;
        }

        .check input {
            width: auto;
            height: auto;
        }

        .btn {
            width: 100%;
            height: 52px;
            border: 0;
            border-radius: 12px;
            background: #0b63f6;
            color: white;
            font-size: 16px;
            font-weight: 950;
            cursor: pointer;
            margin-top: 8px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            font-weight: 800;
            margin-top: 5px;
        }

        .hint {
            background: #eff6ff;
            color: #1e3a8a;
            border-radius: 14px;
            padding: 14px;
            line-height: 1.6;
            font-weight: 700;
            margin-bottom: 18px;
        }
    </style>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
</head>
<body>

<div class="wrap">
    <a href="{{ route('admin.routers.index') }}">← Back to Routers</a>

    <div class="card">
        <h1>Edit MikroTik Router</h1>

        <div class="hint">
            Leave password empty if you do not want to change it.
        </div>

        <form method="POST" action="{{ route('admin.routers.update', $router) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label>Router Name</label>
                <input name="name" value="{{ old('name', $router->name) }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>VPN/API IP Address</label>
                <input name="ip_address" value="{{ old('ip_address', $router->ip_address) }}" required>
                @error('ip_address') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>API Port</label>
                <input name="api_port" type="number" value="{{ old('api_port', $router->api_port) }}" required>
                @error('api_port') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>API Username</label>
                <input name="username" value="{{ old('username', $router->username) }}" required>
                @error('username') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>New API Password Optional</label>
                <input name="password" type="password">
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Location</label>
                <input name="location" value="{{ old('location', $router->location) }}">
                @error('location') <div class="error">{{ $message }}</div> @enderror
            </div>

            <label class="check">
                <input type="checkbox" name="api_ssl" value="1" {{ $router->api_ssl ? 'checked' : '' }}>
                Use API SSL
            </label>

            <label class="check">
                <input type="checkbox" name="is_active" value="1" {{ $router->is_active ? 'checked' : '' }}>
                Active Router
            </label>

            <button class="btn" type="submit">
                Update Router
            </button>
        </form>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WaveISP Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl font-bold">
                W
            </div>

            <h1 class="text-3xl font-bold mt-4 text-slate-900">
                WaveISP Admin
            </h1>

            <p class="text-slate-500 mt-2">
                Login to manage customers, routers, plans and payments.
            </p>
        </div>

        @if(session('error'))
            <div class="mb-4 rounded-xl bg-red-100 text-red-700 p-3 text-sm font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="admin@waveisp.local"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    value="password123"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-blue-600 text-white py-3 font-bold hover:bg-blue-700"
            >
                Login
            </button>
        </form>
    </div>

</body>
</html>

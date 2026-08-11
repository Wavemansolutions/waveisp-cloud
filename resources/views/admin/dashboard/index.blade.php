<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WaveISP Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">

    <header class="bg-slate-950 text-white">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">
                    WaveISP Cloud
                </h1>
                <p class="text-slate-300 text-sm">
                    Billing, hotspot users, payments and MikroTik control.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="rounded-xl bg-red-600 px-4 py-2 font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Customers</p>
                <h2 class="text-4xl font-bold mt-2">{{ $customersCount }}</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Active Customers</p>
                <h2 class="text-4xl font-bold mt-2">{{ $activeCustomersCount }}</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Plans</p>
                <h2 class="text-4xl font-bold mt-2">{{ $plansCount }}</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Routers</p>
                <h2 class="text-4xl font-bold mt-2">{{ $routersCount }}</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Payments</p>
                <h2 class="text-4xl font-bold mt-2">{{ $paymentsCount }}</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow">
                <p class="text-slate-500">Revenue</p>
                <h2 class="text-4xl font-bold mt-2">₦{{ number_format($successfulRevenue, 2) }}</h2>
            </div>
        </div>

        <div class="mt-8 bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-bold mb-4">
                Next Modules
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="rounded-xl bg-slate-100 p-4 font-semibold">Routers</div>
                <div class="rounded-xl bg-slate-100 p-4 font-semibold">Plans</div>
                <div class="rounded-xl bg-slate-100 p-4 font-semibold">Customers</div>
                <div class="rounded-xl bg-slate-100 p-4 font-semibold">Payments</div>
            </div>
        </div>
    </main>

</body>
</html>

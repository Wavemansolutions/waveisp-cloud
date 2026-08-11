<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RouterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\VpnController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ConnectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\RouterAgentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortalController::class, 'home'])
    ->name('portal.home');


Route::get('/connect', [ConnectController::class, 'connect'])
    ->name('portal.connect');

Route::post('/connect/validate', [ConnectController::class, 'validateVoucher'])
    ->name('portal.connect.validate');

Route::get('/plans', [PortalController::class, 'plans'])
    ->name('portal.plans');

Route::get('/support', [PortalController::class, 'support'])
    ->name('portal.support');

Route::get('/buy/{plan}', [PortalController::class, 'buy'])
    ->name('portal.buy');

Route::post('/buy/{plan}', [PortalController::class, 'submit'])
    ->name('portal.buy.submit');

Route::get('/payment/callback', [PaymentController::class, 'callback'])
    ->name('payment.callback');

Route::post('/webhooks/paystack', [PaymentController::class, 'webhook'])
    ->name('payment.webhook');

Route::post('/payment/test-activate/{payment}', [PaymentController::class, 'testActivate'])
    ->name('payment.testActivate');

Route::post('/payment/retry-mikrotik/{payment}', [PaymentController::class, 'retryMikrotik'])
    ->name('payment.retryMikrotik');

Route::get('/payment/success/{payment}', [PaymentController::class, 'success'])
    ->name('payment.success');

Route::get('/agent/routers/{router}/script', [RouterAgentController::class, 'script'])
    ->name('agent.script');

Route::get('/agent/jobs/{job}/ack', [RouterAgentController::class, 'ack'])
    ->name('agent.ack');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/statistics', [StatisticsController::class, 'index'])
        ->name('statistics');

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

    Route::post('plans/{plan}/toggle', [PlanController::class, 'toggle'])
        ->name('plans.toggle');

    Route::resource('plans', PlanController::class);

    Route::get('customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('customers/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');

    Route::post('customers/{customer}/activate', [CustomerController::class, 'activate'])
        ->name('customers.activate');

    Route::post('customers/{customer}/suspend', [CustomerController::class, 'suspend'])
        ->name('customers.suspend');

    Route::post('customers/{customer}/sync', [CustomerController::class, 'sync'])
        ->name('customers.sync');

    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');

    Route::get('/vpn', [VpnController::class, 'index'])
        ->name('vpn.index');

    Route::get('routers/{router}/agent', [RouterController::class, 'agent'])
        ->name('routers.agent');

    Route::post('routers/{router}/regenerate-agent-token', [RouterController::class, 'regenerateAgentToken'])
        ->name('routers.regenerateAgentToken');

    Route::resource('routers', RouterController::class);

    Route::post('routers/{router}/test', [RouterController::class, 'test'])
        ->name('routers.test');
});
<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RouterController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortalController::class, 'home'])
    ->name('portal.home');

Route::get('/plans', [PortalController::class, 'plans'])
    ->name('portal.plans');

Route::get('/support', [PortalController::class, 'support'])
    ->name('portal.support');

Route::get('/buy/{plan}', [PortalController::class, 'buy'])
    ->name('portal.buy');

Route::post('/buy/{plan}', [PortalController::class, 'submit'])
    ->name('portal.buy.submit');

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

    Route::resource('routers', RouterController::class);

    Route::post('routers/{router}/test', [RouterController::class, 'test'])
        ->name('routers.test');
});
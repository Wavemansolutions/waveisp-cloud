<?php

namespace App\Providers;

use App\Support\SiteSettings;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
            try {
                $view->with('siteSettings', SiteSettings::all());
            } catch (Throwable $e) {
                $view->with('siteSettings', []);
            }
        });
    }
}
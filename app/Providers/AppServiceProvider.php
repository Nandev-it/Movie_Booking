<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');
        App::setLocale(session('locale', 'en'));
        // Force HTTPS in production (helps @vite load assets correctly on Vercel)
        // if (app()->environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}

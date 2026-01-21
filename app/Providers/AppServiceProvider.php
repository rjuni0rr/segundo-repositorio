<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;


use Illuminate\Auth\Events\Login;
use App\Listeners\UpdateLastLogin;


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
        RateLimiter::for('general', function ($request) {
            return Limit::perMinute(2000)->by($request->ip());
        });

        RateLimiter::for('export', function ($request) {
            return Limit::perMinute(2000)->by($request->ip());
        });
    }

    protected $listen = [
        Login::class => [
            UpdateLastLogin::class,
        ],
    ];
}

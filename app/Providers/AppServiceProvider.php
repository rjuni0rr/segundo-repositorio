<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Gate;
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
        RateLimiter::for('login', function ($request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        RateLimiter::for('general', function ($request) {
            return Limit::perMinute(20)->by($request->ip());
        });

        RateLimiter::for('export', function ($request) {
            return Limit::perMinute(20)->by($request->ip());
        });



        // gates para o admin
        Gate::define('admin', function ($user){
            return $user->category_id === 1;
        });

        // gates para o gerente
        Gate::define('manager', function ($user){
            return $user->category_id === 2;
        });

        // gates para o funcionario
        Gate::define('employee', function ($user){
            return $user->category_id === 3;
        });

        // gates para o visitante
        Gate::define('guest', function ($user){
            return $user->category_id === 4;
        });
    }

    protected $listen = [
        Login::class => [
            UpdateLastLogin::class,
        ],
    ];
}

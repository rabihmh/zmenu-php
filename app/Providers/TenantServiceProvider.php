<?php

namespace App\Providers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(User::class, function () {
            return auth()->user();
        });
        $this->app->singleton(Restaurant::class, function () {
            return auth()->user()->restaurant;
        });
    }

    /**
     * Bootstrap services.
     */
    public
    function boot(): void
    {
        //
    }
}

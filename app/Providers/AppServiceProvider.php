<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DoctorApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(DoctorApiService::class, function ($app) {
        return new DoctorApiService();
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

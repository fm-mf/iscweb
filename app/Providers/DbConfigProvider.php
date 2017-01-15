<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\DbConfig\DbConfig;

class DbConfigProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DbConfig::class, function ($app) {
            return new DbConfig();
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Settings\Settings;

class SettingsProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    //defer registration of this provider until it's needed
    protected $defer = true;
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
        $this->app->singleton('settings', function ($app) {
            return new Settings();
        });
    }
    public function provides(){
        return [Settings::class];
    }
}

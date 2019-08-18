<?php

namespace App\Providers;

use App\Facades\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('shortName', Settings::get('shortName'));
        View::share('fullName', Settings::get('fullName'));
        View::share('officialName', Settings::get('officialName'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Facades\Settings;
use App\Models\AlumniNewsletter;
use App\Observers\AlumniNewsletterObserver;
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
        View::share('linkOwFbEvent', Settings::get('owFbEventLink'));

        AlumniNewsletter::observe(AlumniNewsletterObserver::class);
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

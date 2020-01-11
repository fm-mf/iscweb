<?php

namespace App\Providers;

use App\Facades\Settings;
use App\Models\AlumniNewsletter;
use App\Models\Contact;
use App\Observers\AlumniNewsletterObserver;
use App\Observers\ContactObserver;
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
        View::share('fbPageUrl', 'https://www.facebook.com/isc.ctu.prague/');
        View::share('pointPhoneNo', '+420775198605');
        View::share('pointPhoneNoFormatted', '+420 775 198 605');

        AlumniNewsletter::observe(AlumniNewsletterObserver::class);
        Contact::observe(ContactObserver::class);
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

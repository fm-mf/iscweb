<?php

namespace App\Providers;

use App\Models\AlumniNewsletter;
use App\Models\Contact;
use App\Models\User;
use App\Observers\AlumniNewsletterObserver;
use App\Observers\ContactObserver;
use App\Observers\UserObserver;
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
        AlumniNewsletter::observe(AlumniNewsletterObserver::class);
        Contact::observe(ContactObserver::class);
        User::observe(UserObserver::class);
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

<?php

namespace App\Providers;

use App\Exports\Concerns\WithStyles;
use App\Exports\Concerns\WithStylesHandler;
use App\Models\AlumniNewsletter;
use App\Models\Contact;
use App\Models\DegreeBuddy;
use App\Models\DegreeStudent;
use App\Models\User;
use App\Observers\AlumniNewsletterObserver;
use App\Observers\ContactObserver;
use App\Observers\DegreeBuddyObserver;
use App\Observers\DegreeStudentObserver;
use App\Observers\UserObserver;
use App\Rules\PaymentMethodRule;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Excel::extend(WithStyles::class, new WithStylesHandler(), AfterSheet::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        AlumniNewsletter::observe(AlumniNewsletterObserver::class);
        Contact::observe(ContactObserver::class);
        User::observe(UserObserver::class);
        DegreeStudent::observe(DegreeStudentObserver::class);
        DegreeBuddy::observe(DegreeBuddyObserver::class);

        Validator::extend(PaymentMethodRule::HANDLE, [new PaymentMethodRule(), 'passes']);
    }
}

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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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

        Blade::directive('flag', function (string $countryCode) {
            $flagA = 0x1F1E6;
            $A = ord('A');
            return "<?php echo mb_chr($flagA + (ord(strtoupper($countryCode)[0]) - $A), 'UTF-8') . mb_chr($flagA + (ord(strtoupper($countryCode)[1]) - $A), 'UTF-8') ?>";
        });
    }
}

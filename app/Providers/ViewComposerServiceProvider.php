<?php

namespace App\Providers;

use App\Facades\Settings;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        ViewFacade::composer('*', function (View $view) {
            $view->with([
                'shortName' => Settings::get('shortName'),
                'fullName' => Settings::get('fullName'),
                'officialName' => Settings::get('officialName'),
                'linkOwFbEvent' => Settings::get('owFbEventLink'),
                'fbPageUrl' => 'https://www.facebook.com/isc.ctu.prague/',
                'igProfileUrl' => 'https://www.instagram.com/isc.cvut/',
                'fbGroupCzechBuddies' => 'https://www.facebook.com/groups/isc.ctu.buddies',
                'pointPhoneNo' => '+420775198605',
                'pointPhoneNoFormatted' => '+420 775 198 605',
                'membershipFee' => Settings::membershipFee(),
                'buddyDiscordLink' => 'https://discord.gg/UMa2N7MZQh',
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

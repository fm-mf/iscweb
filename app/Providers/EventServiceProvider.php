<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\BuddyRegistered' => [
            'App\Listeners\NotifyHRNewRegistration',
//            'App\Listeners\AsanaNewRegistration',
            'App\Listeners\SendVerificationEmail',
        ],
        'App\Events\BuddyVerified' => [
                'App\Listeners\WelcomeBuddy',
        ],
        'App\Events\BuddyWithoutEmailRegistered' => [
            'App\Listeners\NotifyHRNoEmail',
            //'App\Listeners\AsanaTaskNoEmail',
        ],
        'App\Events\ExchangeStudentPicked' => [
            'App\Listeners\NotifyExchangeStudent'
        ],
        'App\Events\StudentReservedSpot' => [
            'App\Listeners\Reserved'
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserLoggedIn'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

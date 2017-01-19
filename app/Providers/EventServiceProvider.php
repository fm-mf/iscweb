<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\BuddyRegistered' => [
            'App\Listeners\NotifyHRNewRegistration',
        ],
        'App\Events\BuddyWithoutEmailRegistered' => [
            'App\Listeners\NotifyHRNoEmail',
            'App\Listeners\AsanaTaskNoEmail',
        ],
        'App\Events\ExchangeStudentPicked' =>[
            'App\Listeners\NotifyExchangeStudent'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

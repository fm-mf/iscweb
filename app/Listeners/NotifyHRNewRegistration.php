<?php

namespace App\Listeners;

use App\Events\BuddyRegistered;
use App\Mail\HRNewRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyHRNewRegistration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BuddyRegistered  $event
     * @return void
     */
    public function handle(BuddyRegistered $event)
    {
        Mail::to('hr@isc.cvut.cz')->send(new HRNewRegistration($event->buddy));
    }
}

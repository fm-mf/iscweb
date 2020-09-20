<?php

namespace App\Listeners;

use App\Events\BuddyWithoutEmailRegistered;
use App\Mail\HRNewNoEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyHRNoEmail
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
     * @param  BuddyWithoutEmailRegistered  $event
     * @return void
     */
    public function handle(BuddyWithoutEmailRegistered $event)
    {
        Mail::to('hr@isc.cvut.cz')->send(new HRNewNoEmail($event->buddy));
    }
}

<?php

namespace App\Listeners;

use App\Events\BuddyWithoutEmailRegistered;
use App\Mail\HRNoEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Models\Buddy;

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
        //Mail::to('hr@isc.cvut.cz')->send(new HRNoEmail($event->buddy, $event->motivation));
    }
}

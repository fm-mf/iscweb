<?php

namespace App\Listeners;

use App\Events\BuddyRegistered;
use App\Mail\VerifyUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationEmail
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
        if ($event->buddy->isVerified() || $event->buddy->isDenied()) {
            return;
        }

        Mail::to($event->buddy->verification_email)
            ->send(new VerifyUser($event->buddy->person));
    }
}

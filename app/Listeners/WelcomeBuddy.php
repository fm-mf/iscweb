<?php

namespace App\Listeners;


use App\Events\BuddyVerified;
use App\Mail\WelcomeToBuddyProgramme;
use Illuminate\Support\Facades\Mail;

class WelcomeBuddy
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
     * @param  BuddyVerified  $event
     * @return void
     */
    public function handle(BuddyVerified $event)
    {
        if (!$event->buddy->isWelcomeSent() && $event->buddy->isSubscribed()) {
            Mail::to($event->buddy->person->user->email)->send(new WelcomeToBuddyProgramme());
            if (!in_array($event->buddy->person->user->email, Mail::failures())) {
                $event->buddy->welcome_mail_sent = 1;
                $event->buddy->save();
            }
        }
    }
}
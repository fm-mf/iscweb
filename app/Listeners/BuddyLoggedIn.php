<?php

namespace App\Listeners;


use App\Models\Buddy;
use Illuminate\Auth\Events\Login;

class BuddyLoggedIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $buddy = Buddy::findBuddy($event->user->getAuthIdentifier());
        if ($buddy != null) {
            $buddy->last_login = new \DateTime();
            $buddy->save();
        }
    }
}
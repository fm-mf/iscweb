<?php

namespace App\Listeners;


use App\Models\Buddy;
use App\Models\TandemUser;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class UserLoggedIn
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
        if ($event->user instanceof TandemUser) {
            $event->user->last_login = Carbon::now();
            $event->user->save();
            return;
        }

        $buddy = Buddy::findBuddy($event->user->getAuthIdentifier());
        if ($buddy != null) {
            $buddy->last_login = Carbon::now();
            $buddy->save();
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\BuddyWithoutEmailRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsanaTaskNoEmail
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
        $note = 'Motivace: ' . $event->motivation . "\r\n" . "\r\n";
        $note .= 'Jméno: ' . $event->buddy->person->first_name . ' ' . $event->buddy->person->last_name ."\r\n";
        $note .= 'Email: ' . $event->buddy->person->user->email . "\r\n";
        if (isset($event->buddy->phone)) {
            $note .= 'Telefon: ' . $event->buddy->phone . "\r\n";
        }
        if (isset($event->buddy->about)) {
            $note .= 'About: ' .$event->buddy->about;
        }

        asana()->createTask([
            'name' => $event->buddy->person->first_name . ' ' . $event->buddy->person->last_name . ' [Buddy bez univerzitniho emailu]',
            'assignee' => 'it.support@esn.cvut.cz',
            'notes' => $note,
        ]);
    }
}

<?php

namespace App\Listeners;

use App\Events\BuddyRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsanaNewRegistration
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
        $note = 'Jméno: ' . $event->buddy->person->first_name . ' ' . $event->buddy->person->last_name ."\r\n";
        $note .= 'Email: ' . $event->buddy->person->user->email . "\r\n";
        if (isset($event->buddy->phone)) {
            $note .= 'Telefon: ' . $event->buddy->phone . "\r\n";
        }
        if (isset($event->buddy->about)) {
            $note .= 'About: ' . $event->buddy->about;
        }

        asana()->createTask([
            'projects' => '251802217416353',
            'name' => $event->buddy->person->first_name . ' ' . $event->buddy->person->last_name . ' [Nový buddík]',
            'assignee' => 'it.support@isc.cvut.cz',
            'notes' => $note,
        ]);
    }
}

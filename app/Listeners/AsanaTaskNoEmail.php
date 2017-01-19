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
        asana()->createTask([
            'name' => $event->buddy->person->first_name . ' ' . $event->buddy->person->last_name . ' [Buddy bez univerzitniho emailu]',
            'assignee' => 'it.support@isc.cvut.cz',
            'notes' => 'Motivace: ' . $event->motivation,
        ]);
    }
}

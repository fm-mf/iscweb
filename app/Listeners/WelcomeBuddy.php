<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21.8.17
 * Time: 16:48
 */

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
        Mail::to($event->buddy->person->user->email)->send(new WelcomeToBuddyProgramme());
    }
}
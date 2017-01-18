<?php

namespace App\Listeners;

use App\Events\ExchangeStudentPicked;
use App\Mail\InformAboutPick;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyExchangeStudent
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
     * @param  ExchangeStudentPicked  $event
     * @return void
     */
    public function handle(ExchangeStudentPicked $event)
    {
        Mail::to($event->exchangeStudent->person->user->email)->send(new InformAboutPick($event->buddy));
    }
}

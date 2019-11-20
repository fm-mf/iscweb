<?php

namespace App\Listeners;

use App\Events\StudentReservedSpot;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Mail;

class Reserved
{
    public function handle(StudentReservedSpot $event)
    {
        Mail::to($event->response->user->email)->send(new ReservationMail($event->response));
    }
}

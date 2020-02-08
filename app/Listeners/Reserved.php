<?php

namespace App\Listeners;

use App\Events\StudentReservedSpot;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Reserved
{
    public function handle(StudentReservedSpot $event)
    {
        if (!$event->response->event->ow) {
            try {
                Mail::to($event->response->user->email)->send(new ReservationMail($event->response));
            } catch (\Exception $ex) {
                Log::error("Failed to send email to {$event->response->user->email}");
                Log::error($ex);
            }
        }
    }
}

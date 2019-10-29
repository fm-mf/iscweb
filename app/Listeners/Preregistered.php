<?php

namespace App\Listeners;

use App\Events\StudentPreregistered;
use App\Mail\PreregistrationMail;
use Illuminate\Support\Facades\Mail;

class Preregistered
{
    public function handle(StudentPreregistered $event)
    {
        Mail::to($event->response->user->email)->send(new PreregistrationMail($event->response));
    }
}

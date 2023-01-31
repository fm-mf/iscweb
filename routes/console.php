<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function () {
    $emails = [
        'president@isc.cvut.cz',
        'vicepresident@isc.cvut.cz',
    ];
    $student = \App\Models\ExchangeStudent::with('person.user')->where('id_user', 4777)->first();
    foreach ($emails as $email) {
        \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\RegistrationMail($student));
        $this->comment('Mail send to ' . $email);
    }
});

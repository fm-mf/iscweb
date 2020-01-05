<?php

namespace App\Mail;

use App\Facades\Settings;
use App\Models\ExchangeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $exchangeStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExchangeStudent $exchangeStudent)
    {
        $this->exchangeStudent = $exchangeStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registrationsmail')
                ->from('buddy@isc.cvut.cz', 'ISC CTU in Prague')
                ->subject('Buddy Program ISC CTU in Prague')
                ->with('hash', $this->exchangeStudent->person->user->hash)
                ->with('settings', Settings::all());
    }
}

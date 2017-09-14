<?php

namespace App\Mail;

use App\Models\ExchangeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationReminderMail extends Mailable
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
        return $this->view('emails.reminder')
            ->with('hash', $this->exchangeStudent->person->user->hash)
            ->from('buddy@isc.cvut.cz', 'ISC CTU in Prague')
            ->subject('Buddy Program Registration');
    }
}

<?php

namespace App\Mail;

use App\Facades\Settings;
use App\Models\ExchangeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationReminderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    const SUBJECT = 'Buddy programme ESN CTU in Prague';

    public $exchangeStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ExchangeStudent $exchangeStudent)
    {
        $this->exchangeStudent = $exchangeStudent;
        $this->queue = 'emails';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('buddy@esn.cvut.cz', 'ESN CTU in Prague')
            ->to($this->exchangeStudent->user->email, $this->exchangeStudent->person->full_name)
            ->subject(self::SUBJECT)
            ->view('emails.exchange-registration-reminder')
            ->text('emails.exchange-registration-reminder_plain')
            ->with('subject', self::SUBJECT)
            ->with('buddyDbFrom', Settings::buddyDbFrom());
    }
}

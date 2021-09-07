<?php

namespace App\Mail;

use App\Models\ExchangeStudent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NoBuddyEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    const SUBJECT = 'We still do not have a Buddy for you';

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
            ->from('buddy@isc.cvut.cz', 'ISC CTU in Prague')
            ->to($this->exchangeStudent->user->email, $this->exchangeStudent->person->full_name)
            ->subject(self::SUBJECT)
            ->view('emails.exchange-no-buddy')
            ->text('emails.exchange-no-buddy_plain')
            ->with('subject', self::SUBJECT);
    }
}

<?php

namespace App\Mail;

use App\Models\Buddy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HRNewNoEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    const SUBJECT = 'Nový buddy bez univerzitního e-mailu';

    public $buddy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy)
    {
        $this->buddy = $buddy;
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
            ->from('it.support@isc.cvut.cz', 'IT Support ISC CTU in Prague')
            ->to('hr@isc.cvut.cz', 'HR ISC CTU in Prague')
            ->subject(self::SUBJECT)
            ->view('emails.buddy-without-email')
            ->text('emails.buddy-without-email_plain')
            ->with('subject', self::SUBJECT);
    }
}

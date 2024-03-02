<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\ExchangeStudent;

class VotingMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $exchangeStudent;
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
        return $this->view('emails.voting')->with([
            'hash' => $this->exchangeStudent->person->user->hash,
        ])->subject('ESN inteGREAT - Vote for the best presentations')->from('integreat@esn.cvut.cz');
    }
}

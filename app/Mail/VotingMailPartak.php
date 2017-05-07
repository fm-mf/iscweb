<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Buddy;

class VotingMailPartak extends Mailable
{
    use Queueable, SerializesModels;

    protected $buddy;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy)
    {
        $this->buddy = $buddy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.votingPartak')->with([
            'hash' => $this->buddy->person->user->hash,        
        ])->subject('ISC inteGREAT - Vote for the best presentations')->from('integreat@isc.cvut.cz');
    }
}

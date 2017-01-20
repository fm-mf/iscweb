<?php

namespace App\Mail;

use App\Models\Buddy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HRNoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $buddy;
    public $motivation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy, $motivation)
    {
        $this->buddy = $buddy;
        $this->motivation = $motivation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.noEmail')
                    ->with(['buddy' => $this->buddy, 'motivation' => $this->motivation])
                    ->from('it.support@isc.cvut.cz')
                    ->subject('Opět dobré zprávy!');
    }
}

<?php

namespace App\Mail;

use App\Models\Buddy;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HRNewNoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $buddy;

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
        return $this->view('emails.noEmail')
                    ->from('it.support@isc.cvut.cz')
                    ->subject('Nový buddy bez univerzitního e-mailu');
    }
}

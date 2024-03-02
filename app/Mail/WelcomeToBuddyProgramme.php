<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeToBuddyProgramme extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcomeToBuddyProgramme')
                ->subject(__('emails.welcome.subject'))
                ->from('buddy@esn.cvut.cz', 'Buddy ESN CTU in Prague');
    }
}

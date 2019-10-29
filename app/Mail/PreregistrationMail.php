<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\PreregistrationResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreregistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var PreregistrationResponse */
    public $response;

    public function __construct(PreregistrationResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.preregistration', [
                'event' => $this->response->event,
                'response' => $this->response
            ])
            ->from('events@isc.cvut.cz', 'ISC CTU in Prague')
            ->subject("You've registered for {$this->response->event->name}");
    }
}

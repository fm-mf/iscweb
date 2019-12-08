<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\EventReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var EventReservation */
    public $response;

    public function __construct(EventReservation $response)
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
        return $this->view('emails.reservationCancelled', [
                'event' => $this->response->event,
                'response' => $this->response
            ])
            ->from('events@isc.cvut.cz', 'ISC CTU in Prague')
            ->subject("Your reservation for {$this->response->event->name} was cancelled");
    }
}

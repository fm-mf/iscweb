<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\EventReservation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var EventReservation */
    public $response;

    /** @var User */
    public $cancelledBy;

    public function __construct(EventReservation $response, User $cancelledBy = null)
    {
        $this->response = $response;
        $this->cancelledBy = $cancelledBy;
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
                'response' => $this->response,
                'cancelledBy' => $this->cancelledBy
            ])
            ->from('events@esn.cvut.cz', 'ESN CTU in Prague')
            ->subject("Your reservation for {$this->response->event->name} was cancelled");
    }
}

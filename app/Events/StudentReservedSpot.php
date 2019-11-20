<?php

namespace App\Events;

use App\Models\Event;
use App\Models\EventReservation;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class StudentReservedSpot
{
    use InteractsWithSockets, SerializesModels;

    /** @var EventReservation */
    public $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(EventReservation $response)
    {
        $this->response = $response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

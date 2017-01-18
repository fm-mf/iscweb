<?php

namespace App\Events;

use App\Models\Buddy;
use App\Models\ExchangeStudent;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ExchangeStudentPicked
{
    use InteractsWithSockets, SerializesModels;

    public $buddy;
    public $exchangeStudent;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy, ExchangeStudent $exchangeStudent)
    {
        $this->buddy = $buddy;
        $this->exchangeStudent = $exchangeStudent;
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

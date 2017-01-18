<?php

namespace App\Events;

use App\Models\Buddy;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BuddyWithoutEmailRegistered
{
    use InteractsWithSockets, SerializesModels;

    public $buddy;
    public $motivation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Buddy $buddy, $motivation)
    {
        $this->buddy = $buddy;
        $this->motivation = $motivation;
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

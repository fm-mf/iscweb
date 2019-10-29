<?php
namespace App\Events;

use App\Models\Event;
use App\Models\PreregistrationResponse;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class StudentPreregistered
{
    use InteractsWithSockets, SerializesModels;

    /** @var PreregistrationResponse */
    public $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PreregistrationResponse $response)
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

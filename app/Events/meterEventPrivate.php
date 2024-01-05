<?php

namespace App\Events;

use App\Models\Meter;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class meterEventPrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The data for the event.
     *
     * @var string
     */

    /**
     * Create a new event instance.
     */
    private $data;
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // get the meter id from the Meter model

        $id = Auth::user()->F_MID;
        return [
            new PrivateChannel('private.meter-channel.' . $id),
        ];
    }
    // name of the event
    public function broadcastAs(): string
    {
        return 'meter-event';
    }

    public function broadcastWith(): array
    {
        return [
            'data' => $this->data,
        ];
    }
    // save data to database

}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportReady implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exportId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($exportId)
    {
        $this->exportId = $exportId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('export-status.' . $this->exportId);
    }
}

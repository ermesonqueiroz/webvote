<?php

namespace App\Events;

use App\Models\Option;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Option $option;

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('options.' . $this->option->id);
    }
}

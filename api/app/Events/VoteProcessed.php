<?php

namespace App\Events;

use App\Models\Option;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VoteProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private readonly Option $option) {}

    public function broadcastWith(): array
    {
        return $this->option->toArray();
    }

    public function broadcastOn(): string
    {
        return 'options.' . $this->option->id;
    }

    public function broadcastAs(): string
    {
        return 'vote.processed';
    }
}

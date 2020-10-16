<?php

namespace App\Events;

use App\Models\Match;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $match;
    public $email;

    /**
     * Create a new event instance.
     * @param  Match  $match
     * @param  String  $email
     * @return void
     */
    public function __construct(Match $match, $email)
    {
        $this->match = $match;
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

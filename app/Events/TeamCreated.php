<?php

namespace App\Events;

use App\Models\Team;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TeamCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $team;
    public $email;

    /**
     * Create a new event instance.
     *
     * @param  Team  $team
     * @param  string  $email
     * @return void
     */
    public function __construct(Team $team, string $email)
    {
        $this->team = $team;
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

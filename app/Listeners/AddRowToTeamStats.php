<?php

namespace App\Listeners;

use App\Events\TeamCreated;
use App\Models\TeamStat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddRowToTeamStats
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TeamCreated  $event
     * @return void
     */
    public function handle(TeamCreated $event)
    {
        $team = $event->team;

        TeamStat::create([
            'team_id' => $team->id,
            'tournament_id' => null
        ]);
    }
}

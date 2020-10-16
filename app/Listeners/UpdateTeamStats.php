<?php

namespace App\Listeners;

use App\Events\MatchCreated;
use App\Models\TeamStat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTeamStats
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
     * @param  MatchCreated  $event
     * @return void
     */
    public function handle(MatchCreated $event)
    {
        $match = $event->match;
        foreach ($match->teams as $idx => $team) {
            $statsForTeam = TeamStat::where('team_id', $team->id)->first();
            $statsForTeam->games++;
            if ($team->isHomeInMatch($match)) {
                $statsForTeam->goals_for += $match->home_team_goals;
                $statsForTeam->goals_against += $match->away_team_goals;
            } else {
                $statsForTeam->goals_for += $match->away_team_goals;
                $statsForTeam->goals_against += $match->home_team_goals;
            }
            $statsForTeam->goals_difference = $statsForTeam->goals_for - $statsForTeam->goals_against;
            if ($idx === 0) {
                if ($team->goalsInMatch($match) > $match->teams[1]->goalsInMatch($match)) {
                    $statsForTeam->wins += 1;
                    $statsForTeam->points += 3;
                } elseif ($team->goalsInMatch($match) < $match->teams[1]->goalsInMatch($match)) {
                    $statsForTeam->losses += 1;
                } else {
                    $statsForTeam->draws += 1;
                    $statsForTeam->points += 1;
                }
            } else {
                if ($team->goalsInMatch($match) > $match->teams[0]->goalsInMatch($match)) {
                    $statsForTeam->wins += 1;
                    $statsForTeam->points += 3;
                } elseif ($team->goalsInMatch($match) < $match->teams[0]->goalsInMatch($match)) {
                    $statsForTeam->losses += 1;
                } else {
                    $statsForTeam->draws += 1;
                    $statsForTeam->points += 1;
                }
            }
            $statsForTeam->save();
        }
    }
}

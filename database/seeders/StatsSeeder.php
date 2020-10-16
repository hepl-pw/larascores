<?php

namespace Database\Seeders;

use App\Models\TeamStat;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = Tournament::with([
            'teams' => function ($q) {
                $q->distinct();
            }
        ])->get();

        foreach ($tournaments as $tournament) {
            foreach ($tournament->teams as $team) {
                TeamStat::create([
                    'team_id' => $team->id,
                    'tournament_id' => $tournament->id,
                    'games' => $team->matches_count,
                    'points' => $team->points,
                    'wins' => $team->wins,
                    'losses' => $team->losses,
                    'draws' => $team->draws,
                    'goals_for' => $team->goals_for,
                    'goals_against' => $team->goals_against,
                    'goals_difference' => $team->goals_difference
                ]);
            }
        }

        //$teams = Team::with('matches.teams')->get();

    }
}

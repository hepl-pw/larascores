<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Match;
use App\Models\Participation;
use App\Models\Team;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allTeams = [
            'EPL' => Team::whereIn('name',
                ['Arsenal', 'Chelsea FC', 'Tottenham', 'Manchester United', 'Manchester City', 'Liverpool'])->get(),
            'FAC' => Team::whereIn('name',
                ['Arsenal', 'Chelsea FC', 'Tottenham', 'Manchester United'])->get(),
            'ISA' => Team::whereIn('name', ['Juventus', 'Napoli', 'Lazio Roma', 'Inter Milan'])->get(),
            'SLL' => Team::whereIn('name', ['Real Madrid', 'Barcelona FC', 'Sevilla', 'Atletico Madrid'])->get()
        ];

        foreach ($allTeams as $competitionSlug => $teams) {

            $w = now()->subMonths(random_int(2, 10));
            foreach ($teams as $team1) {
                foreach ($teams as $team2) {
                    $w->addDays(3);
                    if ($team1->slug !== $team2->slug) {
                        $matchSlug = $team1->slug.$team2->slug;
                        $m = Match::create([
                            'played_at' => $w->format('d/m/Y H:i'),
                            'slug' => $matchSlug
                        ]);
                        $p1 = Participation::create([
                            'match_id' => $m->id,
                            'team_id' => $team1->id,
                            'tournament_id' => Competition::whereSlug($competitionSlug)->first()->tournaments->where('span_years',
                                '2020-2021')->first()->id,
                            'goals' => random_int(0, 4),
                            'is_home' => true
                        ]);
                        Participation::create([
                            'match_id' => $m->id,
                            'team_id' => $team2->id,
                            'tournament_id' => $p1->tournament_id,
                            'goals' => random_int(0, 4),
                            'is_home' => false
                        ]);
                    }
                }
            }
        }

    }
}

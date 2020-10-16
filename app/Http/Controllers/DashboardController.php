<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\TeamStat;
use App\Models\Tournament;
use Illuminate\Support\Facades\Schema;
use function request;

class DashboardController extends Controller
{
    public function index()
    {
        $season = request()->query('season', now()->year.'-'.now()->addYear()->year);
        $competition_id = request()->query('competition', 1);

        $tournament = Tournament::with([
            'competition',
            'participations.match.teams',
            'participations.team.matches'
        ])
            ->where('span_years', $season)
            ->where('competition_id', $competition_id)
            ->firstOrFail();

        $sortStatsKey = request()->query('s');
        $sortMatchesKey = request()->query('m');

        if (!Schema::hasColumn('teams_stats', $sortStatsKey)) {
            $sortStatsKey = 'points';
        }

        $secondaryKey = $sortStatsKey !== 'points' ? 'points' : 'goals_difference';

        // Fetching matches according to selected tournament
        $matches = $tournament->matches($sortMatchesKey);

        //Fetching stats according to selected tournament
        $teamsStats = TeamStat::with('team')
            ->where('tournament_id', $tournament->id)
            ->orderByDesc($sortStatsKey)
            ->orderByDesc($secondaryKey)
            ->get();

        $span_years = Tournament::orderBy('span_years')->get()->unique('span_years');
        $competitions = Competition::orderBy('name')->get();

        return view('dashboard',
            compact('matches',
                'teamsStats',
                'sortStatsKey',
                'sortMatchesKey',
                'span_years',
                'competitions',
                'competition_id',
                'season'
            ));
    }
}

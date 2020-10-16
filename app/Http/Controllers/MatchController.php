<?php

namespace App\Http\Controllers;

use App\Events\MatchCreated;
use App\Http\Requests\StoreMatchRequest;
use App\Models\Match;
use App\Models\Team;
use App\Models\Tournament;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{

    public function store(StoreMatchRequest $request)
    {
        $validatedData = $request->validated();
        DB::transaction(function () use ($validatedData) {
            // Fetch the teams
            $homeTeam = Team::where('slug', strtoupper($validatedData['home-team']))->first();
            $awayTeam = Team::where('slug', strtoupper($validatedData['away-team']))->first();

            // Create the Match
            $match = Match::create([
                'played_at' => $validatedData['played_at'],
                'slug' => strtoupper($homeTeam->slug.$awayTeam->slug),
            ]);

            // Attach the teams
            $match->teams()->attach($homeTeam->id, [
                'is_home' => 1,
                'goals' => $validatedData['home-team-goals'],
                'tournament_id' => $validatedData['tournament']
            ]);

            $match->teams()->attach($awayTeam->id, [
                'is_home' => 0,
                'goals' => $validatedData['away-team-goals'],
                'tournament_id' => $validatedData['tournament']
            ]);

            // Fire the event to update stats and notify creator by mail
            event(new MatchCreated($match, request()->user()->email));
        });

        return redirect(RouteServiceProvider::HOME);
    }

    public function create()
    {
        $teams = Team::orderBy('name')->get();
        $tournaments = Tournament::with('competition')
            ->get()
            ->sortByDesc('name')
            ->values();

        return view('match.create', compact('teams', 'tournaments'));
    }
}

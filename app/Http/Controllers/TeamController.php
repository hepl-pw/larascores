<?php

namespace App\Http\Controllers;

use App\Events\TeamCreated;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Providers\RouteServiceProvider;
use App\Uploads\Logos;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    use Logos;

    public function create()
    {
        $teams = Team::with('media')->orderBy('name')->get();

        return view('team.create', compact('teams'));
    }

    public function store(StoreTeamRequest $request)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $request) {
            $team = Team::create($validated);
            if ($request->hasFile('logo')) {
                $team->addMediaFromRequest('logo')
                    ->withResponsiveImages()
                    ->toMediaCollection();
            }

            event(new TeamCreated($team, request()->user()->email));
        });

        return redirect(route('new_team'));
    }

    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($request, $team, $validated) {
            if ($request->hasFile('logo')) {
                $team->addMediaFromRequest('logo')
                    ->withResponsiveImages()
                    ->toMediaCollection();
            }

            $team->update($validated);
        });


        return redirect(RouteServiceProvider::HOME);
    }
}

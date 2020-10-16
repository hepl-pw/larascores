<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Team extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    //protected $withCount = ['matches'];
    protected $fillable = ['name', 'slug', 'file_name'];

    public function matches()
    {
        return $this
            ->belongsToMany(Match::class, 'participations')
            ->withPivot('goals', 'is_home', 'tournament_id');
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, 'participations');
    }

    public function setSlugAttribute($value)
    {
        $this
            ->attributes['slug'] = strtoupper($value);
    }

    public function isHomeInMatch(Match $match)
    {
        return $this
            ->matches
            ->filter(function ($m) use ($match) {
                return $m->is($match);
            })
            ->first()
            ->pivot
            ->is_home;
    }

    public function goalsInMatch(Match $match)
    {
        return $this
            ->matches
            ->filter(function ($m) use ($match) {
                return $m->is($match);
            })
            ->first()
            ->pivot
            ->goals;
    }

    public function getMatchesCountAttribute()
    {
        return $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id))
            ->count();
    }

    public function matchesOfTournament($tournament)
    {
        return $this
            ->matches
            ->where('pivot.tournament_id', $tournament->id);
    }

    public function getGoalsDifferenceAttribute()
    {
        return $this->getGoalsForAttribute() - $this->getGoalsAgainstAttribute();
    }

    public function getGoalsForAttribute()
    {
        return $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id))
            ->sum(function ($match) {
                return $match
                    ->pivot
                    ->goals;
            });
    }

    public function getGoalsAgainstAttribute()
    {
        $matchesWithOpponents = $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id))
            ->load([
                'teams' => function ($query) {
                    return $query->where('teams.id', '!=', $this->id);
                }
            ]);
        return $matchesWithOpponents
            ->sum(function ($match) {
                return $match
                    ->teams
                    ->first()
                    ->pivot
                    ->goals;
            });

    }

    public function getPointsAttribute()
    {
        return $this->wins * 3 + $this->draws;
    }

    public function getWinsAttribute()
    {
        $winsCount = 0;
        $matches = $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id));
        foreach ($matches as $match) {
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $otherTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $otherTeamGoals = $match->teams[0]->pivot->goals;
            }
            if ($thisTeamGoals > $otherTeamGoals) {
                $winsCount++;
            }
        }

        return $winsCount;
    }

    public function getDrawsAttribute()
    {
        $drawsCount = 0;
        $matches = $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id));
        foreach ($matches as $match) {
            if ($match->teams[0]->pivot->goals === $match->teams[1]->pivot->goals) {
                $drawsCount++;
            }
        }

        return $drawsCount;
    }

    public function getLossesAttribute()
    {
        $lossesCount = 0;
        $matches = $this
            ->matchesOfTournament(Tournament::find($this->pivot->tournament_id));
        foreach ($matches as $match) {
            if ($match->teams[0]->id === $this->id) {
                $thisTeamGoals = $match->teams[0]->pivot->goals;
                $otherTeamGoals = $match->teams[1]->pivot->goals;
            } else {
                $thisTeamGoals = $match->teams[1]->pivot->goals;
                $otherTeamGoals = $match->teams[0]->pivot->goals;
            }
            if ($thisTeamGoals < $otherTeamGoals) {
                $lossesCount++;
            }
        }

        return $lossesCount;
    }
}

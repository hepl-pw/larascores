<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $draws
 * @property-read mixed $goals_against
 * @property-read mixed $goals_difference
 * @property-read mixed $goals_for
 * @property-read mixed $losses
 * @property-read int|null $matches_count
 * @property-read mixed $points
 * @property-read mixed $wins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Match[] $matches
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participation[] $participations
 * @property-read int|null $participations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

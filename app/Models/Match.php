<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Match
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $played_at
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $away_team_goals
 * @property-read mixed $away_team_name
 * @property-read mixed $competition
 * @property-read mixed $home_team_goals
 * @property-read mixed $home_team_name
 * @property-read mixed $tournament
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participation[] $participations
 * @property-read int|null $participations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match wherePlayedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Match extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'played_at'];

    protected $dates = ['played_at'];

    public function participations()
    {
        return $this->belongsToMany(Participation::class);
    }

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class, Participation::class);
    }

    public function getTournamentAttribute()
    {
        return $this->tournaments()->first();
    }

    public function getCompetitionAttribute()
    {
        return $this->tournament->competition;
    }

    public function teams()
    {
        return $this
            ->belongsToMany(Team::class, 'participations')
            ->withPivot('goals', 'is_home', 'tournament_id');
    }

    public function setPlayedAtAttribute($value)
    {
        $this->attributes['played_at'] = Carbon::createFromFormat('d/m/Y H:i', $value);
    }

    public function getHomeTeamNameAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 1;
        })->first()->name;
    }

    public function getAwayTeamNameAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 0;
        })->first()->name;
    }

    public function getHomeTeamGoalsAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 1;
        })->first()->pivot->goals;
    }

    public function getAwayTeamGoalsAttribute()
    {
        return $this->teams->filter(function ($team) {
            return $team->pivot->is_home === 0;
        })->first()->pivot->goals;
    }
}

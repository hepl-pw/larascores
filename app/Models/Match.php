<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'played_at'];

    protected $dates = ['played_at'];

    public function participations()
    {
        return $this->belongsToMany(Participation::class);
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

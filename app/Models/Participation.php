<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Participation
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property int $tournament_id
 * @property int $goals
 * @property int $is_home
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Match $match
 * @property-read \App\Models\Team $team
 * @property-read \App\Models\Tournament $tournament
 * @method static \Illuminate\Database\Eloquent\Builder|Participation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Participation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Participation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Participation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}

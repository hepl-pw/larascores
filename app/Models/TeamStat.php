<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TeamStat
 *
 * @property int $id
 * @property int $team_id
 * @property int|null $tournament_id
 * @property int $games
 * @property int $points
 * @property int $wins
 * @property int $losses
 * @property int $draws
 * @property int $goals_for
 * @property int $goals_against
 * @property int $goals_difference
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereDraws($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereGames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereGoalsAgainst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereGoalsDifference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereGoalsFor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereLosses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereTournamentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamStat whereWins($value)
 * @mixin \Eloquent
 */
class TeamStat extends Model
{
    use HasFactory;

    protected $table = 'teams_stats';
    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

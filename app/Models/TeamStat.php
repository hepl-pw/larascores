<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'participations');
    }

    public function matches($sortKey = 'played_at')
    {
        $matches = collect();
        $participations = $this->participations;
        foreach ($participations as $participation) {
            if (!$matches->contains($participation->match)) {
                $matches->add($participation->match);
            }
        }
        return $matches->sortBy($sortKey);
    }

    public function getNameAttribute()
    {
        return $this->span_years.' - '.$this->competition->name;
    }
}

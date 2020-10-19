<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

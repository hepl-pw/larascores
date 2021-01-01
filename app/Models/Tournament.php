<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Tournament
 *
 * @property int $id
 * @property int $competition_id
 * @property string $span_years
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Competition $competition
 * @property-read mixed $name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participation[] $participations
 * @property-read int|null $participations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament whereSpanYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tournament whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

    // TODO: default values should come from config
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

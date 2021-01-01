<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competition
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $span_years
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participation[] $participations
 * @property-read int|null $participations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tournament[] $tournaments
 * @property-read int|null $tournaments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    public function participations()
    {
        return $this->hasManyThrough(Participation::class, Tournament::class);
    }

    public function getSpanYearsAttribute()
    {
        return $this->tournaments->unique('span_years')->pluck('span_years');
    }
}

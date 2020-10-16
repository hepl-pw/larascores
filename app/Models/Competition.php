<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

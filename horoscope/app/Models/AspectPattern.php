<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AspectPattern extends Model
{
    use HasFactory;

    protected $table = 'h_aspect_patterns';

    protected $fillable = [
        'id',
        'aspect_id',
        'from_planet_id',
        'to_planet_id',
        'content',
        'content_en',
        'content_solar',
        'content_solar_en',
    ];

    function aspect(): HasOne
    {
        return $this->hasOne(Aspect::class, 'id', 'aspect_id');
    }

    function fromPlanet(): HasOne
    {
        return $this->hasOne(Planet::class, 'id', 'from_planet_id');
    }

    function toPlanet(): HasOne
    {
        return $this->hasOne(Planet::class, 'id', 'to_planet_id');
    }
}
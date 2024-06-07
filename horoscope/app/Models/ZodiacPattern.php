<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ZodiacPattern extends Model
{
    use HasFactory;

    protected $table = 'h_zodiac_patterns';

    protected $fillable = [
        'zodiac_id',
        'planet_id',
        'content',
        'content_en',
        'published',
    ];

    public function zodiac(): HasOne
    {
        return $this->hasOne(Zodiac::class, 'id', 'zodiac_id');
    }

    public function planet(): HasOne
    {
        return $this->hasOne(Planet::class, 'id', 'planet_id');
    }
}
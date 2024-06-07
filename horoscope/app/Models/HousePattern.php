<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HousePattern extends Model
{
    use HasFactory;

    protected $table = 'h_house_patterns';

    protected $fillable = [
        'house_id',
        'planet_id',
        'published',
        'content',
        'content_en',
    ];

    public function house(): HasOne
    {
        return $this->hasOne(House::class, 'id', 'house_id');
    }

    public function planet(): HasOne
    {
        return $this->hasOne(Planet::class, 'id', 'planet_id');
    }
}

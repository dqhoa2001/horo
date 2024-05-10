<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aspect extends Model
{
    use HasFactory;

    protected $table = 'm_aspects';

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'type',
        'angle',
        'symbol',
    ];

    public function aspectAngle(): HasMany
    {
        return $this->hasMany(AspectAngle::class, 'angle', 'angle');
    }
}
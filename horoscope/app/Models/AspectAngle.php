<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspectAngle extends Model
{
    use HasFactory;

    protected $table = 'm_aspect_angles';

    protected $fillable = [
        'id',
        'type',
        'angle',
        'symbol',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $table = 'h_planets';

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'symbol',
    ];
}

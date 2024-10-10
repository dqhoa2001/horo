<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'h_histories';

    protected $fillable = [
        'id',
        'name',
        'year',
        'month',
        'day',
        'longitude',
        'latitude',
        'timezone',
    ];
}

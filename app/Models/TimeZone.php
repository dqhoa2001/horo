<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeZone extends Model
{
    use HasFactory;

    protected $table = 'h_time_zone';

    protected $fillable = [
        'id',
        'name',
        'timezone',
    ];
}

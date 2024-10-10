<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'h_houses';

    protected $fillable = [
        'id',
        'name',
        'name_en',
        'symbol',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SabianPattern extends Model
{
    use HasFactory;

    protected $table = 'h_sabian_patterns';

    protected $fillable = [
        'zodiac_id',
        'sabian_degrees',
        'title',
        'title_en',
        'content',
        'content_en',
        'published',
    ];

    public function zodiac(): HasOne
    {
        return $this->hasOne(Zodiac::class, 'id', 'zodiac_id');
    }
}
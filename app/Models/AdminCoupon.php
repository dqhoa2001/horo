<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminCoupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'time_limit_day' => 'date',
    ];
    
    ////////// リレーションエリア //////////
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    ////////// リレーションエリア //////////
}

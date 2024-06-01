<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
        'birthday_time' => 'datetime',
    ];

    ////// リレーションエリア　↓ ////////
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // familyの鑑定申し込み
    public function appraisalApplies(): MorphMany
    {
        return $this->morphMany('App\Models\AppraisalApply', 'reference');
    }
    // family solar
    public function solarApplies(): MorphMany
    {
        return $this->morphMany('App\Models\SolarApply', 'reference');
    }
    ////// リレーションエリア　↑ ////////

    // フルネームを取得する
    public function getFullNameAttribute(): string
    {
        return $this->name1 . $this->name2;
    }
}

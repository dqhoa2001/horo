<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SolarResultOtherInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    ///////　リレーションエリア　////////
    public function solarResult(): BelongsTo
    {
        return $this->belongsTo(SolarResult::class);
    }
}

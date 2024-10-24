<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppraisalResult extends Model
{
    use HasFactory;

    protected $guarded = [];

    ///////　リレーションエリア　////////
    public function appraisalResultOtherInfos(): HasMany
    {
        return $this->hasMany(AppraisalResultOtherInfo::class);
    }
}

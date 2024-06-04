<?php

namespace App\Models;

use App\Models\User;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SolarBookbindingUserApply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'scheduled_shipping_date' => 'date',
        'is_delivery' => 'boolean',

    ];

    // 発送済み
    const DELIVERED = 1;

    // 未発送
    const UNDELIVERED = 0;

    const DELIVERY_STATUSES = [
        1 => '発送済み',
        0 => '未発送',
    ];

    const DELIVERY_STATUS_COLOR = [
        1 => 'text-dark',
        0 => 'text-danger',
    ];

    public function getDeliveryStatusText(): string
    {
        return self::DELIVERY_STATUSES[$this->is_delivery];
    }

    public function getChangeStatusButtonText(): array
    {
        $btnClass = $this->is_delivery ? 'btn-outline-dark' : 'btn-outline-success';
        $btnText = $this->is_delivery ? '未発送に変更' : '発送済みに変更';
        return [
            'btnClass' => $btnClass,
            'btnText' => $btnText,
        ];
    }

    /////////////////////// リレーション ///////////////////////
    public function solarApply(): BelongsTo
    {
        return $this->belongsTo(SolarApply::class);
    }

    public function solarClaim(): HasOne
    {
        return $this->hasOne(SolarClaim::class);
    }
}

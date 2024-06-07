<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppraisalClaim extends Model
{
    use HasFactory;

    protected $guarded = [];

    // キャスト
    protected $casts = [
        'purchase_date' => 'date',
        'paid_at' => 'date',
        'is_paid' => 'boolean',
    ];

    const CREDIT = 1;

    const BANK = 2;

    //送料
    const SHIPPING_FEE = 1200;

    const PAYMENT_TYPE = [
        1 => 'クレジットカード',
        2 => '銀行振込',
    ];

    const PERSONAL = 1;

    const FAMILY = 2;

    const PERSONAL_BOOKING = 3;

    const FAMILY_BOOKING = 4;

    const BOOKING = 5;

    const SOLAR = 6;
    const CONTENT_TYPE = [
        1 => '個人鑑定',
        2 => '家族鑑定',
        3 => '個人鑑定+製本',
        4 => '家族鑑定+製本',
        5 => '製本',
        6 => 'SOLAR RETURN',
    ];

    const PAID = 1;

    const UNPAID = 0;

    const PAY_STATUSES = [
        '支払済み' => true,
        '未払い' => false,
    ];

    // const PAY_STATUS_COLOR = [
    //     1 => 'text-dark',
    //     0 => 'text-danger',
    // ];

    // 購入内容の取得
    public function getContentTypeText(): string
    {
        return self::CONTENT_TYPE[$this->content_type];
    }

    // 支払い方法の取得
    public function getPaymentTypeText(): string
    {
        return self::PAYMENT_TYPE[$this->payment_type];
    }

    // 支払い状況の取得
    // public function getPayStatusText(): string
    // {
    //     return self::PAY_STATUSES[$this->is_paid];
    // }

    // 支払い状況に応じたclassの取得
    public function getPayStatusColor(): string
    {
        if ($this->is_paid === true) {
            return 'text-dark';
        }

        return 'text-danger';
    }

    // 製本の同時購入の有無
    public function isBookbinding(): bool
    {
        return $this->content_type === self::PERSONAL_BOOKING || $this->content_type === self::FAMILY_BOOKING || $this->content_type === self::BOOKING;
    }

    // クーポンコードの

    ///////　リレーション ///////
    public function appraisalApply(): BelongsTo
    {
        return $this->belongsTo(AppraisalApply::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function bookbindingUserApply(): BelongsTo
    {
        return $this->belongsTo(BookbindingUserApply::class);
    }
}

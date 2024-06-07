<?php

namespace App\Models;

use App\Models\BookbindingUserApply;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppraisalApply extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'birthday' => 'date',
        'birthday_time' => 'datetime',
        'solar_return' =>'integer',
    ];

    const USER = 1; // 個人

    const FAMILY = 2; // 家族

    const BOOK_DISABLED = 0; // 製本を希望しない

    const BOOK_ENABLED = 1; // 製本の希望

    const CASH_PAYMENT = 1; // クレジットカード

    const STORE_PAYMENT = 2; // コンビニ決済

    const PDF_SOPHIA = 10; //ソフィア

    const PDF_KLEOS = 20; //クレオス

    const PDF_DYNAMIS = 30; //デュナミス

    // PDFの種類
    const PDF_TYPE = [
        self::PDF_SOPHIA => 'SOPHIA',
        self::PDF_KLEOS => 'KLEOS',
        self::PDF_DYNAMIS => 'DYNAMIS',
    ];

    // 申し込み者
    const TARGET_TYPE = [
        self::USER => '自分',
        self::FAMILY => '家族',
    ];

    // 完了画面用
    const COMPLETE_TARGET_TYPE = [
        self::USER => '個人',
        self::FAMILY => '家族',
    ];

    // 製本の希望
    // const IS_BOOKBINDING = [
    //     self::BOOK_ENABLED => '希望する',
    //     self::BOOK_DISABLED => '希望しない',
    // ];

    // 支払い方法
    const PAYMENT_TYPE = [
        self::CASH_PAYMENT => 'クレジットカード',
        self::STORE_PAYMENT => 'コンビニ決済',
    ];

    // 退会したユーザーまたはその家族の取得
    public function withTrashedApplyReference(): Model
    {
        $reference = User::withTrashed()->where('id', $this->reference_id)->first();
        if($this->reference_type === Family::class) {
            $reference = Family::where('id', $this->reference_id)->first();
        }

        return $reference;
    }

    ////// リレーションエリア↓ ////////

    // 鑑定結果
    public function appraisalResults(): HasMany
    {
        return $this->hasMany(AppraisalResult::class);
    }

    // ポリモーフィック
    public function reference(): MorphTo
    {
        return $this->morphTo()->withTrashed();
    }

    //家族のみ
    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class, 'reference_id', 'id');
    }

    //ユーザーのみ
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reference_id', 'id');
    }

    // 鑑定履歴
    public function appraisalClaim(): HasOne
    {
        return $this->hasOne(AppraisalClaim::class);
    }

    // 製本申し込み情報
    public function bookbindingUserApplies(): HasMany
    {
        return $this->hasMany(BookbindingUserApply::class);
    }


    // SOLAR 製本申し込み情報
    public function solarBookbindingUserApplies(): HasMany
    {
        return $this->hasMany(SolarBookbindingUserApply::class);
    }

    ////// リレーションエリア↑ ////////

    // 製本の希望
    public static function getBookbindingType(): array
    {
        $price = Bookbinding::where('is_enabled', Bookbinding::BOOKBINDING)->first()->price;

        return [
            self::BOOK_ENABLED => '希望する（' . number_format($price) . '円）',
            self::BOOK_DISABLED => '希望しない',
        ];
    }
    public static function getSolarBookbindingType(): array
    {
        $price = Bookbinding::where('is_enabled', Bookbinding::BOOKBINDING)->where('solar_return',true)->first()->price;

        return [
            self::BOOK_ENABLED => '希望する（' . number_format($price) . '円）',
            self::BOOK_DISABLED => '希望しない',
        ];
    }
}

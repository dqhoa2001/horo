<?php

namespace App\Enums;

enum CouponType: int
{
    case BACK_COUPON = 1; // バッククーポン
    case INTRODUCTION_COUPON = 2; // 紹介クーポン
    case NONE = 3;

    /** 表示用のテキストを取得 */
    public function text(): string
    {
        return match ($this) {
            self::BACK_COUPON => 'ご紹介ポイントを使用',
            self::INTRODUCTION_COUPON => 'クーポンコードを使用',
            self::NONE => 'クーポンを使用しない',
        };
    }

    public static function toArray(): array
    {
        $enumsArr = CouponType::cases();
        return array_column($enumsArr, 'value');
    }
}

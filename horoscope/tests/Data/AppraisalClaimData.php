<?php

namespace Tests\Data;

use App\Models\AdminCoupon;
use App\Models\AppraisalClaim;
use App\Models\RegisterCoupon;
use App\Models\User;

/**
 * featureテストで必要なフォームデータを定義するクラス
 */
class AppraisalClaimData
{
    //クレジットカード決済
    public static function dataForCredit(): array
    {
        return [
            'payment_type' => AppraisalClaim::CREDIT,
            'coupon_code' => null,
            'discount_price' => 0,
            'total_amount' => 13300,
            'stripeToken' => 'tok_visa',
        ];
    }

    //銀行決済
    public static function dataForBank(): array
    {
        return [
            'payment_type' => AppraisalClaim::BANK,
            'coupon_code' => null,
            'discount_price' => 0,
            'total_amount' => 13300,
        ];
    }

    //招待クーポン使用
    public static function dataForBankAndUsingRegisterCouponCode(): array
    {
        return [
            'payment_type' => AppraisalClaim::BANK,
            'coupon_code' => User::find(1)->welcome_code,
            'discount_price' => RegisterCoupon::first()->coupon_price,
            'back_point' => RegisterCoupon::first()->back_point,
            'total_amount' => 8800 - RegisterCoupon::first()->coupon_price,
        ];
    }

    //管理者クーポン使用
    public static function dataForBankAndAdminCouponCode(): array
    {
        return [
            'payment_type' => AppraisalClaim::BANK,
            'coupon_code' => AdminCoupon::find(1)->coupon_code,
            'discount_price' => AdminCoupon::find(1)->coupon_price,
            'back_point' => AdminCoupon::find(1)->back_point,
            'total_amount' => 8800 - AdminCoupon::find(1)->coupon_price,
        ];
    }
}

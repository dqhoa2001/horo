<?php

namespace App\Services;

use App\Models\User;
use App\Models\AdminCoupon;
use App\Models\RegisterCoupon;
use Illuminate\Database\Eloquent\Builder;

class CouponService
{
    // バックポイントの付与
    public static function updateBackPoint(string $couponCode): void
    {
        //admin_couponsはインフルエンサー用のクーポン、usersは一般のクーポン。
        //入力されたクーポンコードから、どちらのテーブルにあるかを判定する
        $adminCoupon = AdminCoupon::where('coupon_code', $couponCode)->first();
        $inviter = User::where('welcome_code', $couponCode)->first(); // inviter = 紹介者

        // クーポンコードとバックポイント対象のユーザーIDを返す
        if ($adminCoupon) {
            $user = $adminCoupon->user;
            // dd($inviter->point_sum, $adminCoupon->back_point);
            $user->update([
                'point_sum' => $user->point_sum + $adminCoupon->back_point,
            ]);
        }

        //ユーザーregister_coupons
        if ($inviter) {
            $inviter->update([
                'point_sum' => $inviter->point_sum + RegisterCoupon::first()->back_point,
            ]);
        }
    }

    // クーポンお使用する際の処理
    public static function useCoupon(User $user, string $couponCode): void
    {
        // バックポイントを付与する
        self::updateBackPoint($couponCode);

        // クーポンコードが会員クーポンの場合
        if (User::where('welcome_code', $couponCode)->exists()) {
            // クーポンコードを使用済みにする
            $user->update([
                'is_used_welcome_code' => true,
            ]);

            // 使用回数をデクリメントする（99の場合はデクリメントしない）
            if (RegisterCoupon::first()->use_limit !== 99) {
                RegisterCoupon::first()->decrement('use_limit');
            }
        }

        // クーポンコードが管理者クーポンの場合
        if (AdminCoupon::where('coupon_code', $couponCode)->exists()) {
            // 使用回数が99の場合はデクリメントしない
            if (AdminCoupon::where('coupon_code', $couponCode)->first()->use_limit !== 99) {
                AdminCoupon::where('coupon_code', $couponCode)->decrement('use_limit');
            }
        }
    }
}

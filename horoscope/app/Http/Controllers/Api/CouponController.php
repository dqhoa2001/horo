<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\AdminCoupon;
use Illuminate\Http\Request;
use App\Models\AppraisalClaim;
use App\Models\RegisterCoupon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    //取得したクーポンコードから、割引額を取得する
    public function getDiscountPrice(Request $request): \Illuminate\Http\JsonResponse
    {
        //admin_couponsはインフルエンサー用のクーポン、usersは一般のクーポン。
        //入力されたクーポンコードから、どちらのテーブルにあるかを判定する
        $adminCoupon = AdminCoupon::where('coupon_code', $request['params']['coupon_code'])->first();
        $user = User::where('welcome_code', $request['params']['coupon_code'])->first();

        // クーポンコードとバックポイント対象のユーザーIDを返す
        if ($adminCoupon) {
            // リクエストタイプが存在する場合は、そのタイプに応じてクーポンを使用できるか判定する
            if ( ! empty($request['params']['request_type'])) {
                if ($request['params']['request_type'] === 'personal') {
                    if (!$adminCoupon->is_personal_appr_enabled) {
                        return response()->json([
                            'message' => '個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'family') {
                    if (!$adminCoupon->is_family_appr_enabled) {
                        return response()->json([
                            'message' => '家族の個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'offer') {
                    // 99は無制限を意味し、使用回数の判定を行わない
                    if ($adminCoupon->use_limit !== 99) {
                        // 管理者クーポンの使用回数が0の場合は、使用できない
                        if ($adminCoupon->use_limit === 0) {
                            return response()->json([
                                'message' => 'こちらのクーポンコードは現在使用することができません。',
                            ]);
                        }
                    }
                }

                if ($request['params']['request_type'] === 'offer') {
                    if(!$adminCoupon->is_personal_appr_enabled){
                        return response()->json([
                            'message' => '個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'personalSR') {
                    if (!$adminCoupon->is_personal_solar_return_appr_enabled) {
                        return response()->json([
                            'message' => 'SR個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'familySR') {
                    if (!$adminCoupon->is_family_solar_return_appr_enabled) {
                        return response()->json([
                            'message' => 'SR家族の個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'SRbookbinding' || $request['params']['request_type'] === 'bookbinding') {
                    return response()->json([
                        'message' => '割引コードは書籍の注文には適用されません',
                    ]);
                }
            }

            // 例）time_limit_dayが2021-01-01の場合、2021-01-01まで使える
            if ($adminCoupon->time_limit_day < today()->format('Y-m-d')) {
                return response()->json([
                    'message' => 'クーポンコードの有効期限が切れています。',
                ]);
            }

            // 99は無制限を意味し、使用回数の判定を行わない
            if ($adminCoupon->use_limit !== 99  && $request['params']['request_type'] !== 'offer') {
                // 管理者クーポンの使用回数が上限に達しているかどうかを判定する（会員登録後）
                $countUsedAdminCoupon = User::find($request['params']['user_id'])->countUsedAdminCoupon($adminCoupon->coupon_code);
                if ($adminCoupon->use_limit <= $countUsedAdminCoupon) {
                    return response()->json([
                        'message' => 'クーポンコードの使用回数が上限に達しています。',
                    ]);
                }
            }

            return response()->json([
                'discount_price' => $adminCoupon->coupon_price,
            ]);
        }

        //ユーザーregister_coupons
        if ($user) {

            // リクエストタイプが存在する場合は、そのタイプに応じてクーポンを使用できるか判定する
            if ( ! empty($request['params']['request_type'])) {
                if ($request['params']['request_type'] === 'personal') {
                    if (!RegisterCoupon::first()->is_personal_appr_enabled) {
                        return response()->json([
                            'message' => '個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'family') {
                    if (!RegisterCoupon::first()->is_family_appr_enabled) {
                        return response()->json([
                            'message' => '家族の個人鑑定にクーポンを使用できません。',
                        ]);
                    }
                }

                if ($request['params']['request_type'] === 'offer') {
                    if (RegisterCoupon::first()->use_limit === 0) {
                        return response()->json([
                            'message' => '現在、招待クーポンの使用はできません。',
                        ]);
                    }
                }
            }

            if ($user->isCouponTimeLimitOver()) {
                return response()->json([
                    'message' => 'クーポンコードの有効期限が切れています。',
                ]);
            }

            // 99は無制限を意味し、使用回数の判定を行わない。または、会員登録前の場合は使用回数の判定を行わない
            if (RegisterCoupon::first()->use_limit !== 99 && $request['params']['request_type'] !== 'offer') {
                if (RegisterCoupon::first()->use_limit <= User::find($request['params']['user_id'])->countUsedRegisterCoupon()) {
                    return response()->json([
                        'message' => 'クーポンコードの使用回数が上限に達しています。',
                    ]);
                }
            }

            return response()->json([
                'discount_price' => RegisterCoupon::first()->coupon_price,
            ]);
        }
        return response()->json([
            'message' => 'クーポンコードが間違っています。',
        ]);
    }
}

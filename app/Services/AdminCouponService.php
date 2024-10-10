<?php

namespace App\Services;

use App\Models\AdminCoupon;
use Illuminate\Database\Eloquent\Builder;

class AdminCouponService
{
    // 検索
    public static function search(array $input): Builder
    {
        $query = AdminCoupon::query();
        if (isset($input['adminCoupon'])) {
            $query->where('coupon_name', 'like', '%' . $input['adminCoupon'] . '%');
        }
        if (isset($input['adminCouponCode'])) {
            $query->where('coupon_code', 'like', '%' . $input['adminCouponCode'] . '%');
        }
        if (isset($input['searchName'])) {
            $query->whereHas('user', static function ($query) use ($input) {
                $query->where('name1', 'like', '%' . $input['searchName'] . '%')->orWhere('name2', 'like', '%' . $input['searchName'] . '%');
            });
        }

        return $query;
    }
}

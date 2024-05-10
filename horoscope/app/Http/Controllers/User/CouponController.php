<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\AppraisalClaim;
use App\Models\RegisterCoupon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->guard('user')->user();
        return view('user.mypage.coupon', [
            'registerCoupon' => RegisterCoupon::first(),
            'user' => $user,
            'usedCouponClaims' => AppraisalClaim::where('coupon_code', $user->welcome_code)->get(),
        ]);
    }
}

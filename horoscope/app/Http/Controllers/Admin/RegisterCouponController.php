<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterCouponController\StoreRequest;
use App\Http\Requests\Admin\RegisterCouponController\UpdateRequest;
use App\Models\RegisterCoupon;
use Illuminate\Http\Request;

class RegisterCouponController extends Controller
{   
    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('admin.register_coupons.edit', [
            'registerCoupon' => RegisterCoupon::first(),
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        RegisterCoupon::first()->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }
}
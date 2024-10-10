<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;

use App\Models\AdminCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCouponController\StoreRequest;
use App\Http\Requests\Admin\AdminCouponController\UpdateRequest;
use App\Services\AdminCouponService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AdminCouponController extends Controller
{
    private AdminCoupon $adminCoupon;

    /**
     * @param AdminCoupon $adminCoupon
     */
    public function __construct(AdminCoupon $adminCoupon)
    {
        $this->adminCoupon = $adminCoupon;
    }

    /**
     * 一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        $adminCoupon = [
            'adminCoupon' => $request->input('adminCoupon'),
            'searchName' => $request->input('searchName'),
            'adminCouponCode' => $request->input('adminCouponCode'),
        ];

        $adminCoupons = AdminCouponService::search($adminCoupon)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.admin_coupons.index', [
            'adminCoupons' => $adminCoupons,
        ]);
    }

    /**
     * 登録フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function create(?User $user = null)
    {
        // $user が存在しないか、$user の id が存在しない場合、デフォルトで 1 を選択
        $selectedUserId = $user && $user->exists ? $user->id : User::DEMY_USER;

        return view('admin.admin_coupons.create', [
            'users' => User::all(),
            'selectedUserId' => $selectedUserId,
        ]);
    }

    /**
     * 登録
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->adminCoupon->fill($request->substitutable())->save();

        return to_route('admin.admin_coupons.index')->with('status', '作成しました');
    }

    /**
     * 編集フォーム表示
     *
     * @return \Illuminate\View\View
     */
    public function edit(AdminCoupon $adminCoupon)
    {
        return view('admin.admin_coupons.edit', [
            'adminCoupon' => $adminCoupon,
            'user' => $adminCoupon->user,
            'users' => User::all(),
        ]);
    }

    /**
     * 更新
     *
     * @param UpdateRequest $request
     * @param AdminCoupon $adminCoupon
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, AdminCoupon $adminCoupon)
    {
        $adminCoupon->fill($request->substitutable())->save();
        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param AdminCoupon $adminCoupon
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AdminCoupon $adminCoupon)
    {
        $adminCoupon->delete();

        return to_route('admin.admin_coupons.index')->with('status', '削除しました');
    }
}

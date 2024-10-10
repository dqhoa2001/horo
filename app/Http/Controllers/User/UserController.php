<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\BankInfo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\User\Withdraw;
use Illuminate\Http\RedirectResponse;
use App\Mail\User\AppraisalReceivedForBank;
use App\Http\Requests\User\UserController\UpdateRequest;

class UserController extends Controller
{
    // 編集
    public function edit(): View
    {
        return view('user.mypage.setting');
    }

    // 更新
    public function update(UpdateRequest $request): RedirectResponse
    {
        auth()->guard('user')->user()->fill($request->substitutable())->save();

        return back()->with('status', '更新しました');
    }

    // 退会
    public function withdraw(): RedirectResponse
    {
        $user = auth()->guard('user')->user();
        \Mail::to($user->email)->send(new Withdraw($user));
        $user->delete();
        return to_route('user.login')->with('status', '退会処理が完了しました。再度ログインしたい場合は管理者へお問い合わせください。');
    }
}

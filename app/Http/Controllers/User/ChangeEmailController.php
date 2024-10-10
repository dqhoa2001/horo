<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\UserEmailReset;
use App\Http\Requests\User\ChangeEmailController\SendChangeEmailLinkRequest;
use App\Mail\UserChangeEmailMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ChangeEmailController extends Controller
{
    /**
     * トークンの有効期限(30分)
     */
    const TOKEN_EXPIRES = 60 * 30;

    // 新しいメールアドレス送信フォーム表示
    public function displayEmailForm(): View
    {
        $currentEmail = auth()->guard('user')->user()->email;
        return view('user.auth.email.reset', compact('currentEmail'));
    }

    // メールアドレス変更確認メール送信
    public function sendChangeEmailLink(SendChangeEmailLinkRequest $request): RedirectResponse
    {
        $newEmail = $request->email;
        
        // トークン生成
        $token = hash_hmac(
            'sha256',
            \Str::random(40) . $newEmail,
            config('app.key')
        );
        
        // トークンをDBに保存
        \DB::beginTransaction();
        try {
            UserEmailReset::create([
                'user_id' => auth()->guard('user')->user()->id,
                'new_email' => $newEmail,
                'token' => $token,
            ]);
            \DB::commit();
            \Mail::to($newEmail)->send(new UserChangeEmailMail($token));
            return redirect()->back()->with('status', '確認メールを送信しました。');
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('flash_alert', 'メール更新に失敗しました。');
        }
    }

    // メールアドレス変更（更新）
    public function updateEmail(string $token): RedirectResponse
    {
        // トークンから新しいメールアドレスとユーザーIDが入っているレコードを取得
        $emailResets = UserEmailReset::where('token', $token)->first();

        // トークンが存在していて、かつ、有効期限が切れていないかチェック
        if ($emailResets && !$this->tokenExpired($emailResets->created_at)) {
            // ユーザーのメールアドレスを更新
            $user = User::find($emailResets->user_id);
            $user->email = $emailResets->new_email;
            $user->save();

            // レコードを削除
            $emailResets->delete();

            return redirect()->route('user.emails.form')->with('status', 'メールアドレスを更新しました');
        }
        // レコードが存在していた場合削除
        if ($emailResets) {
            $emailResets->delete();
        }
        return redirect()->route('user.login')->with('flash_alert', 'トークンの有効期限が切れているか、トークンが不正です。');
    }

    /**
     * * トークンが有効期限切れかどうかチェック
     * 
     * @param string $createdAt
     *
     * @return bool
     */
    protected function tokenExpired($createdAt)
    {
        return Carbon::parse($createdAt)->addSeconds(static::TOKEN_EXPIRES)->isPast();
    }
}

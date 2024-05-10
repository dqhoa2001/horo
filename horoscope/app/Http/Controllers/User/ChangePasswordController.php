<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\ChangePassword\UpdateRequest;
use Illuminate\View\View;

class ChangePasswordController extends Controller
{
    public function edit(): View
    {
        return view('user.auth.passwords.edit');
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->with('status', 'パスワードを変更しました');
    }
}

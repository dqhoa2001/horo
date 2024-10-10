<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // ユーザー登録後のリダイレクト先を設定
    protected $redirectTo = RouteServiceProvider::USER_EMAIL_VERIFY;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    /**
     * Guardの認証方法を指定
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard()
    {
        return \Auth::guard('user');
    }

    /**
     * 新規登録画面
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'kana1' => ['required', 'string', 'max:255'],
            'kana2' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                // ソフトデリートされたレコードは除外する
                Rule::unique('users','email')->where(static function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'email_confirmation' => ['required', 'string', 'email', 'max:255', 'same:email'],
            // 'birthday' => ['required', 'date'],
            'birth_year' => ['required', 'integer', 'between:1900,2100'],
            'birth_month' => ['required', 'integer', 'between:1,12'],
            'birth_day' => ['required', 'integer', 'between:1,31'],
            'password' => ['required', 'string', 'min:8', 'max:12', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $generateUniqueWelcomeCode = User::generateUniqueWelcomeCode();

        $birthday = $data['birth_year'] . '/' . $data['birth_month'] . '/' . $data['birth_day'];

        return User::create([
            'name1' => $data['name1'],
            'name2' => $data['name2'],
            'kana1' => $data['kana1'],
            'kana2' => $data['kana2'],
            'email' => $data['email'],
            // 'birthday' => $data['birthday'],
            'birthday' => $birthday,
            'password' => Hash::make($data['password']),
            'welcome_code' => $generateUniqueWelcomeCode,
        ]);
    }
}

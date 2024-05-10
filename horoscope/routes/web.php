<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\User\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/', 'user/login');

// Route::get('test', [HomeController::class, 'test'])->name('test');

// 開発中ログイン(ユーザー)
Route::get('user_dev_login', static function () {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('user')->login(App\Models\User::first());
    return to_route('user.popup');
})->name('user_dev_login');

Route::get('user_dev_login_id/{id}', static function ($id) {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('user')->login(App\Models\User::find($id));
    return to_route('user.popup');
})->name('user_dev_login_id');

// 開発中ログイン(管理者)
Route::get('admin_dev_login', static function () {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('admin')->login(App\Models\Admin::first());
    return to_route('admin.top');
})->name('admin_dev_login');

Route::get('admin_dev_login_id/{id}', static function ($id) {
    abort_unless(app()->environment('local'), 403);
    auth()->guard('admin')->login(App\Models\Admin::find($id));
    return to_route('admin.top');
})->name('admin_dev_login_id');

// エラー画面テスト
Route::get('500', static function () {
    \Log::error('500エラーのテスト');
    abort(500);
});
Route::get('502', static function () {
    \Log::error('502エラーのテスト');
    abort(502);
});

Route::prefix('samples')->name('samples.')->group(static function () {
    // stripeのテスト
    Route::get('stripes', [SampleController::class, 'stripe'])->name('stripes.index');
    Route::post('stripes/create-payment-intent', [SampleController::class, 'createPaymentIntent'])->name('stripes.create-payment-intent');
    Route::get('stripes/checkout', [SampleController::class, 'checkout'])->name('stripes.checkout');
});

//phpinfo確認
Route::get('phpinfo', static function () {
    phpinfo();
});

\Auth::routes(['verify' => true]);

// サンプル画面
// Route::prefix('samples')->group(function () {

// });

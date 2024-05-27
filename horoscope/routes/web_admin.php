<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TopController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminMailController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Language\LanguageController;
use App\Http\Controllers\Admin\HousePatternController;
use App\Http\Controllers\Admin\AspectPatternController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\SabianPatternController;
use App\Http\Controllers\Admin\ZodiacPatternController;
use App\Http\Controllers\Admin\AppraisalApplyController;
use App\Http\Controllers\Admin\RegisterCouponController;
use App\Http\Controllers\Admin\SolarApplyController;

// ログイン認証関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ログイン認証後
Route::middleware('auth:admin')->group(static function () {
    // 言語切り替え対応
    Route::middleware(['language'])->group(static function () {

        Route::get('change-language/{code}', [LanguageController::class, 'index'])->name('change-language');

        // Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        ### pattern
        Route::prefix('pattern')->name('pattern.')->group(static function () {
            # sabian
            Route::controller(SabianPatternController::class)
                ->prefix('sabian')
                ->group(static function () {
                    Route::get('/', 'index')->name('sabian-list');
                    Route::get('/view/{id?}', 'view')->name('sabian-view');
                    Route::post('/create', 'create')->name('sabian-create');
                    Route::post('/update/{id}', 'update')->name('sabian-update');
                    Route::post('/delete/{id}', 'delete')->name('sabian-delete');
                });
            //zodiac
            Route::controller(ZodiacPatternController::class)
                ->prefix('zodiac')
                ->group(static function () {
                    Route::get('/', 'index')->name('zodiac-list');
                    Route::get('/view/{id?}', 'view')->name('zodiac-view');
                    Route::post('/create', 'create')->name('zodiac-create');
                    Route::post('/update/{id}', 'update')->name('zodiac-update');
                    Route::post('/delete/{id}', 'delete')->name('zodiac-delete');
                });
            //house
            Route::controller(HousePatternController::class)
                ->prefix('house')
                ->group(static function () {
                    Route::get('/', 'index')->name('house-list');
                    Route::get('/view/{id?}', 'view')->name('house-view');
                    Route::post('/create', 'create')->name('house-create');
                    Route::post('/update/{id}', 'update')->name('house-update');
                    Route::post('/delete/{id}', 'delete')->name('house-delete');
                });

            # aspect
            Route::controller(AspectPatternController::class)
                ->prefix('aspect')
                ->group(static function () {
                    Route::get('/', 'index')->name('aspect-list');
                    Route::get('/view/{id?}', 'view')->name('aspect-view');
                    Route::post('/create', 'create')->name('aspect-create');
                    Route::post('/update/{id}', 'update')->name('aspect-update');
                    Route::post('/delete/{id}', 'delete')->name('aspect-delete');
                });
        });
        // # sabian
        // Route::controller(SabianPatternController::class)
        //     ->prefix('pattern/sabian')
        //     ->group(static function () {
        //     Route::get('/', 'index')->name('pattern.sabian-list');
        //     Route::get('/view/{id?}', 'view')->name('pattern.sabian-view');
        //     Route::post('/create', 'create')->name('pattern.sabian-create');
        //     Route::post('/update/{id}', 'update')->name('pattern.sabian-update');
        //     Route::post('/delete/{id}', 'delete')->name('pattern.sabian-delete');
        // });
        // //zodiac
        // Route::controller(ZodiacPatternController::class)
        //     ->prefix('pattern/zodiac')
        //     ->group(static function () {
        //     Route::get('/', 'index')->name('pattern.zodiac-list');
        //     Route::get('/view/{id?}', 'view')->name('pattern.zodiac-view');
        //     Route::post('/create', 'create')->name('pattern.zodiac-create');
        //     Route::post('/update/{id}', 'update')->name('pattern.zodiac-update');
        //     Route::post('/delete/{id}', 'delete')->name('pattern.zodiac-delete');
        // });
        // //house
        // Route::controller(HousePatternController::class)
        //     ->prefix('pattern/house')
        //     ->group(static function () {
        //     Route::get('/', 'index')->name('pattern.house-list');
        //     Route::get('/view/{id?}', 'view')->name('pattern.house-view');
        //     Route::post('/create', 'create')->name('pattern.house-create');
        //     Route::post('/update/{id}', 'update')->name('pattern.house-update');
        //     Route::post('/delete/{id}', 'delete')->name('pattern.house-delete');
        // });

        // # aspect
        // Route::controller(AspectPatternController::class)
        //     ->prefix('pattern/aspect')
        //     ->group(static function () {
        //     Route::get('/', 'index')->name('pattern.aspect-list');
        //     Route::get('/view/{id?}', 'view')->name('pattern.aspect-view');
        //     Route::post('/create', 'create')->name('pattern.aspect-create');
        //     Route::post('/update/{id}', 'update')->name('pattern.aspect-update');
        //     Route::post('/delete/{id}', 'delete')->name('pattern.aspect-delete');
        // });
    });

    // TOPページ
    Route::get('top', [TopController::class, 'top'])->name('top');

    // 会員管理
    Route::patch('users/change_delivery_status/{bookbindingUserApply}', [UserController::class, 'changeDeliveryStatus'])->name('users.change_delivery_status');
    Route::patch('users/change_pay_status/{appraisalClaim}', [UserController::class, 'changePayStatus'])->name('users.change_pay_status');
    Route::post('users/restore/{user}', [UserController::class, 'restore'])->name('users.restore');
    // 未払会員一覧画面の表示
    Route::get('users/unpaid_appraisal_list', [UserController::class, 'unpaidAppraisalList'])->name('users.unpaid_appraisal_list');
    Route::resource('users', UserController::class)->except('create', 'store', 'show');

    // 鑑定編集
    // 鑑定ダウンロード
    Route::post('appraisal_applies/download_pdf/{bookbindingUserApply}', [AppraisalApplyController::class, 'downloadPdf'])->name('appraisal_applies.download_pdf');
    Route::get('appraisal_applies/redirect_users_edit/{appraisalApply}', [AppraisalApplyController::class, 'redirectUsersEdit'])->name('appraisal_applies.redirect_users_edit');
    Route::resource('appraisal_applies', AppraisalApplyController::class)->only('edit', 'update');
    Route::resource('solar_applies', SolarApplyController::class)->only('edit', 'update');
    // クーポン管理
    Route::prefix('coupons')->group(static function () {
        // 会員登録クーポン管理
        Route::prefix('register_coupons')->name('register_coupons.')->group(static function () {
            Route::get('edit', [RegisterCouponController::class, 'edit'])->name('edit');
            Route::patch('update', [RegisterCouponController::class, 'update'])->name('update');
        });

        // 管理者クーポン管理
        Route::resource('admin_coupons', AdminCouponController::class)->except('create', 'show');
        Route::get('admin_coupons/create/{user?}', [AdminCouponController::class, 'create'])->name('admin_coupons.create');
    });

    // 管理者メール管理
    Route::resource('admin_mails', AdminMailController::class)->except(['show']);

});

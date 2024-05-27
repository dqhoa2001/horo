<?php

use App\Http\Controllers\User\SolarAppraisalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CouponController;
use App\Http\Controllers\User\AppraisalController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\BookbindingController;
use App\Http\Controllers\User\ChangeEmailController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\ChangePasswordController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\Auth\ForgotPasswordController;
use App\Http\Controllers\User\FamilyController;
use App\Http\Controllers\User\MyHoroscopeController;
use App\Http\Controllers\User\MySolarHoroscopeController;
use App\Http\Controllers\User\OfferAppraisalController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\Auth\VerificationController;
use App\Http\Controllers\User\FamilyAppraisalController;
use App\Http\Controllers\User\CheckPaymentController;
use App\Http\Controllers\User\CheckPaymentSolarController;
use App\Http\Controllers\User\SolarBookbindingController;

//会員登録しないでホロスコープ
Route::prefix('horoscopes')->name('horoscopes.')->group(static function () {
    Route::get('create', [TopController::class, 'create'])->name('create');
    Route::post('back', [TopController::class, 'back'])->name('back');
    Route::get('predict', [TopController::class, 'predict'])->name('predict');
    Route::get('complete1', [TopController::class, 'complete1'])->name('complete1');
    Route::get('complete2', [TopController::class, 'complete2'])->name('complete2');
    // Route::post('confirm', [TopController::class, 'confirm'])->name('confirm');
    // Route::post('back', [TopController::class, 'back'])->name('back');
    // Route::post('store', [TopController::class, 'store'])->name('store');
    // Route::get('complete', [TopController::class, 'complete'])->name('complete');
});

//会員登録と鑑定申し込み
Route::prefix('offer_appraisals')->name('offer_appraisals.')->group(static function () {
    //鑑定作成画面
    Route::get('create', [OfferAppraisalController::class, 'create'])->name('create');

    //鑑定確認画面
    Route::post('confirm', [OfferAppraisalController::class, 'confirm'])->name('confirm');
    Route::post('back', [OfferAppraisalController::class, 'back'])->name('back');

    //鑑定登録処理
    Route::post('apply', [OfferAppraisalController::class, 'apply'])->name('apply');

    // Route::get('complete/{appraisal_apply}', [OfferAppraisalController::class, 'complete'])->name('complete');
    Route::get('thanks', [OfferAppraisalController::class, 'thanks'])->name('thanks');
});

Route::prefix('check_payment')->name('check_payment.')->middleware(['auth:user', 'verified'])->group(static function () {
    //鑑定作成画面
    Route::get('create', [CheckPaymentController::class, 'create'])->name('create');

    //鑑定確認画面
    Route::post('confirm', [CheckPaymentController::class, 'confirm'])->name('confirm');
    Route::post('back', [CheckPaymentController::class, 'back'])->name('back');

    //鑑定登録処理
    Route::post('apply', [CheckPaymentController::class, 'apply'])->name('apply');

    // Route::get('complete/{appraisal_apply}', [CheckPaymentController::class, 'complete'])->name('complete');
    Route::get('thanks', [CheckPaymentController::class, 'thanks'])->name('thanks');
});

Route::prefix('check_payment_solar')->name('check_payment_solar.')->middleware(['auth:user', 'verified'])->group(static function () {
    //鑑定作成画面
    Route::get('create', [CheckPaymentSolarController::class, 'create'])->name('create');

    //鑑定確認画面
    Route::post('confirm', [CheckPaymentSolarController::class, 'confirm'])->name('confirm');
    Route::post('back', [CheckPaymentSolarController::class, 'back'])->name('back');

    //鑑定登録処理
    Route::post('apply', [CheckPaymentSolarController::class, 'apply'])->name('apply');

    // Route::get('complete/{appraisal_apply}', [CheckPaymentSolarController::class, 'complete'])->name('complete');
    Route::get('thanks', [CheckPaymentSolarController::class, 'thanks'])->name('thanks');
});

// ログイン認証関連
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// 会員登録
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Email Verificationのルート
Route::get('/email/verify', static function () {
    return view('user.auth.verify');
});

// 登録後の確認メール発送通知画面へ遷移
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
// 確認メールのメールアドレス認証ボタンをクリック後のリダイレクトアクション設定
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
// 確認メール再送信用のアクション設定
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::post('reset-session', [VerificationController::class, 'resetSession'])->name('reset-session');

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// パスワードリセット
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// 表紙イメージPDFダウンロード
Route::prefix('download_images')->name('download_images.')->group(static function () {
    // 表紙イメージ
    Route::get('download_sample_pdf',  [BookbindingController::class, 'downloadSamplePdf'])->name('download_sample_pdf');
    // 表紙イメージ（お客様お名前入り）
    Route::get('download_cover_pdf/{design}/{name1}/{name2}',  [BookbindingController::class, 'downloadCoverPdf'])->name('download_cover_pdf');
});

// ログイン認証後
Route::middleware(['auth:user', 'verified'])->group(static function () {

    // ユーザー設定画面
    Route::get('settings', [UserController::class, 'edit'])->name('settings.edit');
    Route::post('update', [UserController::class, 'update'])->name('settings.update');

    //メールアドレス変更
    Route::prefix('emails')->name('emails.')->group(static function () {
        Route::get('{token}', [ChangeEmailController::class, 'updateEmail'])->name('update');
        Route::get('/', [ChangeEmailController::class, 'displayEmailForm'])->name('form');
        Route::post('/', [ChangeEmailController::class, 'sendChangeEmailLink'])->name('send');
    });
    //パスワード変更
    Route::prefix('passwords')->name('passwords.')->group(static function () {
        Route::get('edit', [ChangePasswordController::class, 'edit'])->name('edit');
        Route::patch('/', [ChangePasswordController::class, 'update'])->name('update');
    });

    //退会
    Route::post('withdraw', [UserController::class, 'withdraw'])->name('withdraw');

    //ご紹介クーポン
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/', [TopController::class, 'top'])->name('top');

    // mypage
    Route::get('/popup', [TopController::class, 'popup'])->name('popup');
    // Lineのポップアップを停止
    Route::post('/stop_line_popup', [TopController::class, 'stopLinePopup'])->name('stop_line_popup');

    //家族のホロスコープ
    Route::resource('families', FamilyController::class)->except(['edit']);
    Route::get('families/{family}/edit', [FamilyController::class, 'edit'])->middleware('can:view,family')->name('families.edit');

    //MyHoroscope
    Route::controller(MyHoroscopeController::class)->prefix('my_horoscopes')->name('my_horoscopes.')->group(static function () {
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit', 'edit')->name('edit');
        Route::patch('update', 'update')->name('update');
    });
    //MySolarHoroscope
    Route::controller(MySolarHoroscopeController::class)->prefix('my_solar_horoscopes')->name('my_solar_horoscopes.')->group(static function () {
        // Route::get('create', 'create')->name('create');
        // Route::post('store', 'store')->name('store');
        Route::get('edit', 'edit')->name('edit');
        Route::patch('update', 'update')->name('update');
    });

    //会員登録済みの個人鑑定
    Route::controller(AppraisalController::class)->prefix('appraisals')->name('appraisals.')->group(static function () {
        // 個人鑑定
        Route::get('', 'index')->name('index');
        // サンプルPDFダウンロード
        Route::get('download_sample_pdf', 'downloadSamplePdf')->name('download_sample_pdf');
        // 個人鑑定申し込み
        Route::get('create', 'create')->name('create');
        Route::post('confirm', 'confirm')->name('confirm');
        Route::post('apply', 'apply')->name('apply');
        Route::post('back', 'back')->name('back');
        Route::post('family_back/{target_type}', 'familyBack')->name('family_back');
        Route::get('complete', 'complete')->name('complete');
        // 個人鑑定の詳細
        Route::get('{appraisal_apply}', 'show')->name('show')->middleware('can:viewClaim,appraisal_apply', 'can:viewAppraisalApply,appraisal_apply');
    });

    //MySolarHoroscopeAppraisal
    Route::controller(SolarAppraisalController::class)->prefix('solar_appraisals')->name('solar_appraisals.')->group(static function () {
        // 個人鑑定
        Route::get('', 'index')->name('index');
        // 個人鑑定の詳細
        Route::get('{appraisal_apply}', 'show')->name('show')->middleware('can:viewClaim,appraisal_apply', 'can:viewAppraisalApply,appraisal_apply');
    });

    //家族鑑定
    Route::controller(FamilyAppraisalController::class)->prefix('family_appraisals')->name('family_appraisals.')->group(static function () {
        Route::get('', 'index')->name('index');
        Route::get('{appraisal_apply}', 'show')->name('show')->middleware('can:viewClaim,appraisal_apply', 'can:viewFamilyAppraisalApply,appraisal_apply');
    });

    //問い合わせ
    Route::controller(ContactController::class)->prefix('contacts')->name('contacts.')->group(static function () {
        Route::get('create', 'create')->name('create');
        Route::post('confirm', 'confirm')->name('confirm');
        Route::post('store', 'store')->name('store');
        Route::post('back', 'back')->name('back');
        Route::get('complete', 'complete')->name('complete');
    });

    // 製本
    Route::controller(BookbindingController::class)->prefix('bookbindings')->name('bookbindings.')->group(static function () {
        Route::get('create', 'create')->name('create');
        Route::post('confirm', 'confirm')->name('confirm');
        Route::post('apply', 'apply')->name('apply');
        Route::post('back', 'back')->name('back');
        Route::get('complete', 'complete')->name('complete');
    });

    // SOLAR 製本
    Route::controller(SolarBookbindingController::class)->prefix('solar_bookbindings')->name('solar_bookbindings.')->group(static function () {
        Route::get('create', 'create')->name('create');
        // Route::post('confirm', 'confirm')->name('confirm');
        // Route::post('apply', 'apply')->name('apply');
        // Route::post('back', 'back')->name('back');
        // Route::get('complete', 'complete')->name('complete');
    });

    // Route::prefix('myappraisals')->name('myappraisals.')->group(static function () {
    //     // 個人鑑定
    // })

    //////////////////////////// 素材画面 ↓ ////////////////////////////
    // テンプレートデザイン確認 ----------Front----------
    // entry
    Route::get('samples/front/front-entry', static function () {
        return view('samples.user.front.entry');
    })->name('samples.user.front.entry');
    // offer
    Route::get('samples/front/front-offer', static function () {
        return view('samples.user.front.offer');
    })->name('samples.user.front.offer');
    // login
    Route::get('samples/front/front-login', static function () {
        return view('samples.user.front.login');
    })->name('samples.user.front.login');

    //テンプレートデザイン確認 ----------mypage----------
    // bookmaiking
    Route::get('samples/mypage/mypage-bookmaiking', static function () {
        return view('samples.user.mypage.bookmaiking');
    })->name('samples.user.mypage.bookmaiking');

    // contact
    Route::get('samples/mypage/mypage-contact', static function () {
        return view('samples.user.mypage.contact');
    })->name('samples.user.mypage.contact');

    // coupon
    Route::get('samples/mypage/mypage-coupon', static function () {
        return view('samples.user.mypage.coupon');
    })->name('samples.user.mypage.coupon');

    // familyappraisal-detail
    Route::get('samples/mypage/mypage-familyappraisal-detail', static function () {
        return view('samples.user.mypage.familyappraisal-detail');
    })->name('samples.user.mypage.familyappraisal-detail');

    // familyappraisal-list
    Route::get('samples/mypage/mypage-familyappraisal-list', static function () {
        return view('samples.user.mypage.familyappraisal-list');
    })->name('samples.user.mypage.familyappraisal-list');

    // familyappraisal
    Route::get('samples/mypage/mypage-familyappraisal', static function () {
        return view('samples.user.mypage.familyappraisal');
    })->name('samples.user.mypage.familyappraisal');

    // familyhoroscope-create
    Route::get('samples/mypage/mypage-familyhoroscope-create', static function () {
        return view('samples.user.mypage.familyhoroscope-create');
    })->name('samples.user.mypage.familyhoroscope-create');

    // familyhoroscope-detail
    Route::get('samples/mypage/mypage-familyhoroscope-detail', static function () {
        return view('samples.user.mypage.familyhoroscope-detail');
    })->name('samples.user.mypage.familyhoroscope-detail');

    // familyhoroscope-list
    Route::get('samples/mypage/mypage-familyhoroscope-list', static function () {
        return view('samples.user.mypage.familyhoroscope-list');
    })->name('samples.user.mypage.familyhoroscope-list');

    // familyhoroscope
    Route::get('samples/mypage/mypage-familyhoroscope', static function () {
        return view('samples.user.mypage.familyhoroscope');
    })->name('samples.user.mypage.familyhoroscope');

    // index
    Route::get('samples/mypage/mypage-index', static function () {
        return view('samples.user.mypage.index');
    })->name('samples.user.mypage.index');

    // myappraisal-detail
    Route::get('samples/mypage/mypage-myappraisal-detail', static function () {
        return view('samples.user.mypage.myappraisal-detail');
    })->name('samples.user.mypage.myappraisal-detail');

    // myappraisal
    Route::get('samples/mypage/mypage-myappraisal', static function () {
        return view('samples.user.mypage.myappraisal');
    })->name('samples.user.mypage.myappraisal');

    // myhoroscope-create
    Route::get('samples/mypage/mypage-myhoroscope-create', static function () {
        return view('samples.user.mypage.myhoroscope-create');
    })->name('samples.user.mypage.myhoroscope-create');

    // myhoroscope-detail
    Route::get('samples/mypage/mypage-myhoroscope-detail', static function () {
        return view('samples.user.mypage.myhoroscope-detail');
    })->name('samples.user.mypage.myhoroscope-detail');

    // personal-appraisal-form
    Route::get('samples/mypage/mypage-personal-appraisal-form', static function () {
        return view('samples.user.mypage.personal-appraisal-form');
    })->name('samples.user.mypage.personal-appraisal-form');

    // popup
    Route::get('samples/mypage/mypage-popup', static function () {
        return view('samples.user.mypage.popup');
    })->name('samples.user.mypage.popup');
    //////////////////////////// 素材画面 ↑ ////////////////////////////

});

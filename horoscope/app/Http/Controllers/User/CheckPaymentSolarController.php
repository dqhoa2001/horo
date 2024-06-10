<?php

namespace App\Http\Controllers\User;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Family;
use App\Library\GetMail;
use App\Models\BankInfo;
use App\Enums\TargetType;
use App\Models\AdminMail;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Library\GetPrefNum;
use App\Models\Bookbinding;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\SolarClaim;
use App\Services\CouponService;
use App\Mail\User\CompletePurchaseSolar;
use App\Http\Controllers\Controller;
use App\Mail\User\ThanksForAppraisal;
use Illuminate\Http\RedirectResponse;
use App\Mail\User\BookbindingUserApply;
use App\Services\SolarClaimService;
use App\Mail\User\AppraisalReceivedForBank;
use App\Mail\User\BookbindingUserApplyMail;
use App\Mail\User\BookbindingUserApplyMailForBank;
use App\Http\Requests\User\CheckPaymentSolarController\ApplyRequest;
use App\Http\Requests\User\CheckPaymentSolarController\ConfirmRequest;
use App\Mail\User\CompleteForPersonalAppraisal;
use App\Mail\User\CompleteForFamilyAppraisal;
use App\Mail\User\ThanksForPersonalAppraisal;
use App\Mail\User\ThanksForFamilyAppraisal;
use App\Models\Appraisal;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use App\Services\BookbindingUserApplyService;
use App\Services\FamilyService;
use App\Services\MyHoroscopeService;
use App\Library\GetBccMail;

class CheckPaymentSolarController extends Controller
{
    public function __construct(
        protected SolarClaimService $solarClaimService,
    ) {
    }

    // 会員登録せずに個人鑑定ページの表示
    public function create(Request $request): View
    {
        $bookbinding = Bookbinding::where('is_enabled', true)->where('solar_return',true)->first();
        $solar = Appraisal::where('is_enabled', true)->where('solar_return',true)->first();
        $user = auth()->guard('user')->user();
        $appraisalPrice = $solar->price;
        $defaultBirthday = $user->birthday;
        $defaultBirthdayTime = $user->birthday_time;
        $defaultBirthdayPrefectures = $user->birthday_prefectures;
        $defaultAddress = $user->birthday_prefectures;

        if ((int) $request->target_type === TargetType::FAMILY->value) {
            $appraisalPrice = $solar->family_price;
            $defaultBirthday = null;
            $defaultBirthdayTime = null;
            $defaultBirthdayPrefectures = null;
            $defaultAddress = '東京都杉並区';
        }
        return view('user.check_payment_solar.create', [
            'bookbinding' => $bookbinding,
            'solar'   => $solar,
            'totalAmount' => $solar->price + $bookbinding->price + SolarClaim::SHIPPING_FEE,
            'request'     => $request,
            'appraisalPrice' => $appraisalPrice,
            'defaultBirthday' => $defaultBirthday,
            'defaultBirthdayTime' => $defaultBirthdayTime,
            'defaultBirthdayPrefectures' => $defaultBirthdayPrefectures,
            'defaultAddress' => $defaultAddress,
            'solarYear' => now()->year,
        ]);
    }

    //確認画面
    public function confirm(ConfirmRequest $request): View
    {
        //合計金額をセッションに保存
        $request->session()->put('total_amount', $request['total_amount']);
        return view('user.check_payment_solar.confirm', [
            'data'        => $request,
            'bookbinding' => Bookbinding::where('is_enabled', true)->where('solar_return',true)->first(),
            'solar'   => Appraisal::where('is_enabled', true)->where('solar_return',true)->first(),
        ]);
    }

    // 入力修正へのリダイレクト
    public function back(): RedirectResponse
    {
        return redirect()->route('user.check_payment_solar.create')->withInput();
    }

    // 申し込み処理
    public function apply(Request $request): RedirectResponse
    {
        // dd($request);
        \DB::beginTransaction();
        Stripe::setApiKey(config('services.stripe.secret'));

        $bookbindingUserApply = null;
        $bookbindingUserApplyId = null;
        $user = null;

        // 住所から都道府県番号を取得
        if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
            $prefNum = GetPrefNum::getPrefNum($request->address);
            $request->merge([
                'pref_num' => $prefNum,
            ]);
        }

        // 決済処理
        //クレジット決済の場合
        if ((int) $request->payment_type === SolarClaim::CREDIT) {
            try {
                $stripeToken = $request->stripeToken;
                $paymentMethod = PaymentMethod::create([
                    'type' => 'card',
                    'card' => [
                        'token' => $stripeToken,
                    ],
                ]);

                //鑑定の支払い処理
                $paymentIntent = PaymentIntent::create([
                    'amount' => $request->total_amount,
                    'currency' => 'jpy',
                    'payment_method' => $paymentMethod->id,
                    'confirm' => true,
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never',
                    ],
                ]);

                //家族の場合
                if ((int) $request->target_type === TargetType::FAMILY->value) {
                    $contentType = AppraisalClaim::FAMILY;
                    // $user = UserService::create($request);
                    $user = auth()->guard('user')->user();
                    $family = FamilyService::updateOrCreate($request);
                    $solarApply = AppraisalApplyService::create($request, Family::class, $family->id);

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::FAMILY_BOOKING;
                    }

                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new ThanksForFamilyAppraisal($solarApply));
                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new CompleteForFamilyAppraisal($solarApply));

                //ユーザー自身の場合
                } else {
                    $contentType = AppraisalClaim::SOLAR;

                    // $user = UserService::createUserAndHoroscope($request);
                    $user = auth()->guard('user')->user();
                    $solarApply = AppraisalApplyService::create($request, User::class, $user->id);
                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new ThanksForPersonalAppraisal($solarApply));

                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new CompleteForPersonalAppraisal($solarApply));

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    }
                }

                // 請求データ作成
                $solarClaim = AppraisalClaimService::createForCredit($user->id, $request, $solarApply, $bookbindingUserApplyId, $paymentIntent, $contentType);

                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::warning("決済に失敗しました: {$e->getMessage()}");
                return to_route('user.check_payment_solar.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            }

        //銀行振込の場合
        } else {
            //家族の場合
            if ((int) $request->target_type === TargetType::FAMILY->value) {
                $contentType = AppraisalClaim::FAMILY;
                $user = auth()->guard('user')->user();
                $family = FamilyService::updateOrCreate($request);
                $solarApply = AppraisalApplyService::create($request, Family::class, $family->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::FAMILY_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }
            //ユーザー自身の場合
            } else {
                $contentType = AppraisalClaim::PERSONAL;
                // $user = UserService::createUserAndHoroscope($request);
                $user = auth()->guard('user')->user();
                $solarApply = AppraisalApplyService::create($request, User::class, $user->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }

            }
            // 請求データ作成
            $solarClaim = AppraisalClaimService::createForBank($user->id, $request, $solarApply, $bookbindingUserApplyId, $contentType);
            // コミットとメール送信
            \DB::commit();

            $bccMails = GetBccMail::getBccMail();
            \Mail::to(GetMail::getMailForApply($solarApply))->bcc($bccMails)->send(new AppraisalReceivedForBank(BankInfo::first(), $solarClaim));
        }

        // クーポンの使用
        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        // $bccMails = GetBccMail::getBccMail();
        // \Mail::to(GetMail::getMailForApply($solarApply))->bcc($bccMails)->send(new AppraisalReceivedForBank(BankInfo::first(), $solarClaim));
        return to_route('user.check_payment_solar.complete', [
            'solarApply' => $solarApply,
            'target_type' => $request->target_type,
        ]);

    }
    public function complete(Request $request): View
    {
        $solarApply = AppraisalApply::find($request->solarApply);
        return view('user.check_payment_solar.complete', [
            'solarApply' => $solarApply,
            'target_type' => $request->target_type,
        ]);
    }
    // 完了画面
    public function thanks(Request $request): View
    {
        return view('user.check_payment_solar.thanks');
    }
}

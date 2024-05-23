<?php

namespace App\Http\Controllers\User;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Family;
use App\Library\GetMail;
use App\Models\BankInfo;
use App\Enums\TargetType;
use App\Models\AdminMail;
use App\Models\Solar;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Library\GetPrefNum;
use App\Models\Bookbinding;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\SolarApply;
use App\Models\SolarClaim;
use App\Services\CouponService;
use App\Services\FamilySolarService;
use App\Mail\User\CompletePurchaseSolar;
use App\Http\Controllers\Controller;
use App\Mail\User\ThanksForAppraisal;
use Illuminate\Http\RedirectResponse;
use App\Mail\User\BookbindingUserApply;
use App\Services\SolarApplyService;
use App\Services\SolarClaimService;
use App\Mail\User\SolarReceivedForBank;
use App\Mail\User\BookbindingUserApplyMail;
use App\Services\BookbindingUserSolarApplyService;
use App\Mail\User\BookbindingUserApplyMailForBank;
use App\Http\Requests\User\CheckPaymentSolarController\ApplyRequest;
use App\Http\Requests\User\CheckPaymentSolarController\ConfirmRequest;

class CheckPaymentSolarController extends Controller
{
    public function __construct(
        protected SolarClaimService $solarClaimService,
    ) {
    }

    // 会員登録せずに個人鑑定ページの表示
    public function create(): View
    {
        $bookbinding = Bookbinding::where('is_enabled', true)->first();
        $solar = Solar::where('is_enabled', true)->first();
        return view('user.check_payment_solar.create', [
            'bookbinding' => $bookbinding,
            'solar'   => $solar,
            'totalAmount' => $solar->price + $bookbinding->price + SolarClaim::SHIPPING_FEE
        ]);
    }

    //確認画面
    public function confirm(ConfirmRequest $request): View
    {
        $data = $request->substitutable();
        //合計金額をセッションに保存
        $request->session()->put('total_amount', $data['total_amount']);
        return view('user.check_payment_solar.confirm', [
            'data'        => $data,
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'solar'   => Solar::where('is_enabled', true)->first(),
        ]);
    }

    // 入力修正へのリダイレクト
    public function back(): RedirectResponse
    {
        return redirect()->route('user.check_payment_solar.create')->withInput();
    }

    // 申し込み処理
    public function apply(ApplyRequest $request): RedirectResponse
    {
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
                    $contentType = SolarClaim::FAMILY;
                    // $user = UserService::create($request);
                $user = auth()->guard('user')->user();
                    $family = FamilySolarService::createForAppraosal($request, $user);
                    $solarApply = SolarApplyService::create($request, Family::class, $family->id);

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserSolarApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = SolarClaim::FAMILY_BOOKING;
                    }
                //ユーザー自身の場合
                } else {
                    $contentType = SolarClaim::PERSONAL;

                    // $user = UserService::createUserAndHoroscope($request);
                $user = auth()->guard('user')->user();
                    $solarApply = SolarApplyService::create($request, User::class, $user->id);

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserSolarApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = SolarClaim::PERSONAL_BOOKING;
                    }
                }

                // 請求データ作成
                $solarClaim = SolarClaimService::createForCredit($user->id, $request, $solarApply, $bookbindingUserApplyId, $paymentIntent, $contentType);

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
                $contentType = SolarClaim::FAMILY;
                // $user = UserService::create($request);
                $user = auth()->guard('user')->user();
                $family = FamilySolarService::createForAppraosal($request, $user);
                $solarApply = SolarApplyService::create($request, Family::class, $family->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserSolarApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = SolarClaim::FAMILY_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }
            //ユーザー自身の場合
            } else {
                $contentType = SolarClaim::PERSONAL;
                // $user = UserService::createUserAndHoroscope($request);
                $user = auth()->guard('user')->user();
                $solarApply = SolarApplyService::create($request, User::class, $user->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserSolarApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = SolarClaim::PERSONAL_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }

            }
            // 請求データ作成
            $solarClaim = SolarClaimService::createForBank($user->id, $request, $solarApply, $bookbindingUserApplyId, $contentType);
            // コミットとメール送信
            \DB::commit();

            $allAdminMailAddresses = AdminMail::pluck('email')->toArray();
            $minnaBcc = config('mail.minna_bcc');
            $minnaBccArray = [$minnaBcc]; // 文字列を配列に変換
            $bccMails = array_merge($allAdminMailAddresses, $minnaBccArray);
            \Mail::to(GetMail::getMailForSolarApply($solarApply))->bcc($bccMails)->send(new SolarReceivedForBank(BankInfo::first(), $solarClaim));
        }

        // クーポンの使用
        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        \Mail::to($user->email)->send(new ThanksForAppraisal());
        \Mail::to($user->email)->send(new CompletePurchaseSolar($solarApply));
        return to_route('user.check_payment_solar.thanks');

    }

    // 完了画面
    public function thanks(Request $request): View
    {
        return view('user.check_payment_solar.thanks');
    }
}
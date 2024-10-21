<?php

namespace App\Http\Controllers\User;

use Stripe\Stripe;
use App\Models\User;
use App\Models\Family;
use App\Library\GetMail;
use App\Models\BankInfo;
use App\Enums\TargetType;
use App\Models\AdminMail;
use App\Models\Appraisal;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Library\GetPrefNum;
use App\Models\Bookbinding;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Services\CouponService;
use App\Services\FamilyService;
use App\Mail\User\CompletePurchase;
use App\Http\Controllers\Controller;
use App\Mail\User\ThanksForAppraisal;
use Illuminate\Http\RedirectResponse;
use App\Mail\User\BookbindingUserApply;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use App\Mail\User\AppraisalReceivedForBank;
use App\Mail\User\BookbindingUserApplyMail;
use App\Services\BookbindingUserApplyService;
use App\Mail\User\BookbindingUserApplyMailForBank;
use App\Http\Requests\User\OfferAppraisalController\ApplyRequest;
use App\Http\Requests\User\OfferAppraisalController\ConfirmRequest;

class OfferAppraisalController extends Controller
{
    public function __construct(
        protected AppraisalClaimService $appraisalClaimService,
    ) {
    }

    // 会員登録せずに個人鑑定ページの表示
    public function create(): View
    {
        $bookbinding = Bookbinding::where('is_enabled', true)->first();
        $appraisal = Appraisal::where('is_enabled', true)->first();
        return view('user.offer_appraisals.create', [
            'bookbinding' => $bookbinding,
            'appraisal'   => $appraisal,
            'totalAmount' => $appraisal->price + $bookbinding->price + AppraisalClaim::SHIPPING_FEE
        ]);
    }

    //確認画面
    public function confirm(ConfirmRequest $request): View
    {
        $data = $request->substitutable();
        //合計金額をセッションに保存
        $request->session()->put('total_amount', $data['total_amount']);
        return view('user.offer_appraisals.confirm', [
            'data'        => $data,
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'appraisal'   => Appraisal::where('is_enabled', true)->first(),
        ]);
    }

    // 入力修正へのリダイレクト
    public function back(): RedirectResponse
    {
        return redirect()->route('user.offer_appraisals.create')->withInput();
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
        if ((int) $request->payment_type === AppraisalClaim::CREDIT) {
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
                    $user = UserService::create($request);
                    $family = FamilyService::createForAppraosal($request, $user);
                    $appraisalApply = AppraisalApplyService::create($request, Family::class, $family->id);

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::FAMILY_BOOKING;
                    }
                //ユーザー自身の場合
                } else {
                    $contentType = AppraisalClaim::PERSONAL;
                    $user = UserService::createUserAndHoroscope($request);
                    $appraisalApply = AppraisalApplyService::create($request, User::class, $user->id);
                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    }
                }
                // 請求データ作成
                $appraisalClaim = AppraisalClaimService::createForCredit($user->id, $request, $appraisalApply, $bookbindingUserApplyId, $paymentIntent, $contentType);
                \Mail::to($user->email)->send(new CompletePurchase($appraisalApply));
                
                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::warning("決済に失敗しました: {$e->getMessage()}");
                return to_route('user.offer_appraisals.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            }

        //銀行振込の場合
        } else {
            //家族の場合
            if ((int) $request->target_type === TargetType::FAMILY->value) {
                $contentType = AppraisalClaim::FAMILY;
                $user = UserService::create($request);
                $family = FamilyService::createForAppraosal($request, $user);
                $appraisalApply = AppraisalApplyService::create($request, Family::class, $family->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::FAMILY_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }
            //ユーザー自身の場合
            } else {
                $contentType = AppraisalClaim::PERSONAL;
                $user = UserService::createUserAndHoroscope($request);
                $appraisalApply = AppraisalApplyService::create($request, User::class, $user->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }

            }
            // 請求データ作成
            $appraisalClaim = AppraisalClaimService::createForBank($user->id, $request, $appraisalApply, $bookbindingUserApplyId, $contentType);
            // コミットとメール送信
            \DB::commit();

            $allAdminMailAddresses = AdminMail::pluck('email')->toArray();
            $minnaBcc = config('mail.minna_bcc');
            $minnaBccArray = [$minnaBcc]; // 文字列を配列に変換
            $bccMails = array_merge($allAdminMailAddresses, $minnaBccArray);
            \Mail::to(GetMail::getMailForApply($appraisalApply))->bcc($bccMails)->send(new AppraisalReceivedForBank(BankInfo::first(), $appraisalClaim));
        }

        // クーポンの使用
        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        \Mail::to($user->email)->send(new ThanksForAppraisal());
        // \Mail::to($user->email)->send(new CompletePurchase($appraisalApply));
        return to_route('user.offer_appraisals.thanks');

    }

    // 完了画面
    public function thanks(Request $request): View
    {
        return view('user.offer_appraisals.thanks');
    }
}

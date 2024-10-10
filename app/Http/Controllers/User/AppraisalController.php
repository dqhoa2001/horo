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
use App\Library\GetBccMail;
use App\Library\GetPrefNum;
use App\Models\AdminCoupon;
use App\Models\Bookbinding;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Models\RegisterCoupon;
use App\Services\CouponService;
use App\Services\FamilyService;
use App\Mail\User\CompletePurchase;
use App\Http\Controllers\Controller;
use App\Services\MyHoroscopeService;
use App\Mail\User\ThanksForAppraisal;
use App\Repositories\HouseRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use Modules\Horoscope\Enums\ExplainEnum;
use App\Mail\User\AppraisalReceivedForBank;
use App\Mail\User\BookbindingUserApplyMail;
use App\Mail\User\ThanksForFamilyAppraisal;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Mail\User\CompleteForFamilyAppraisal;
use App\Mail\User\ThanksForPersonalAppraisal;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use App\Services\BookbindingUserApplyService;
use App\Mail\User\CompleteForPersonalAppraisal;
use App\Mail\User\ThanksForFamilyBankAppraisal;
use App\Mail\User\BookbindingUserApplyMailForBank;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use App\Http\Requests\User\AppraisalController\ApplyRequest;
use App\Http\Requests\User\AppraisalController\ConfirmRequest;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;

class AppraisalController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected AppraisalApplyService $appraisalApplyService,
        protected AppraisalClaimService $appraisalClaimService,
    ) {}

    // 個人鑑定
    public function index(Request $request): View|RedirectResponse
    {
        $latestAppraisalApply = AppraisalApply::whereHas('user', static function ($query) {
            $query->where('id', auth()->guard('user')->user()->id);
        })->whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->where('reference_type', User::class)
            ->where('solar_return',0)->latest()->first();
        // 鑑定結果がある場合showへリダイレクト
        if ($latestAppraisalApply) {
            return to_route('user.appraisals.show', $latestAppraisalApply);
        }

        return view('user.appraisals.index', [
            'appraisal'         => Appraisal::where('is_enabled', true)->first(),
            'bookbinding'       => Bookbinding::where('is_enabled', true)->first(),
        ]);
    }

    //個人鑑定申し込み
    public function create(Request $request): View
    {
        $bookbinding = Bookbinding::where('is_enabled', true)->first();
        $appraisal = Appraisal::where('is_enabled', true)->first();

        $user = auth()->guard('user')->user();

        $appraisalPrice = $appraisal->price;
        $defaultBirthday = $user->birthday;
        $defaultBirthdayTime = $user->birthday_time;
        $defaultBirthdayPrefectures = $user->birthday_prefectures;
        $defaultAddress = $user->birthday_prefectures;

        if ((int) $request->target_type === TargetType::FAMILY->value) {
            $appraisalPrice = $appraisal->family_price;
            $defaultBirthday = null;
            $defaultBirthdayTime = null;
            $defaultBirthdayPrefectures = null;
            $defaultAddress = '東京都杉並区';
        }

        return view('user.appraisals.create', [
            'bookbinding' => $bookbinding,
            'appraisal'   => $appraisal,
            'totalAmount' => $appraisal->price + $bookbinding->price + AppraisalClaim::SHIPPING_FEE,
            'request'     => $request,
            'appraisalPrice' => $appraisalPrice,
            'defaultBirthday' => $defaultBirthday,
            'defaultBirthdayTime' => $defaultBirthdayTime,
            'defaultBirthdayPrefectures' => $defaultBirthdayPrefectures,
            'defaultAddress' => $defaultAddress,
        ]);
    }

    //個人鑑定申し込み確認
    public function confirm(ConfirmRequest $request): View
    {
        $data = $request->substitutable();
        //合計金額をセッションに保存
        $request->session()->put('total_amount', $data['total_amount']);
        // dd($data);
        return view('user.appraisals.confirm', [
            'data'        => $data,
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'appraisal'   => Appraisal::where('is_enabled', true)->first(),
        ]);
    }

    // 入力修正へのリダイレクト(個人鑑定へ)
    public function back(): RedirectResponse
    {
        return redirect()->route('user.appraisals.create')->withInput();
    }

    // 入力修正へのリダイレクト(家族鑑定へ)
    public function familyBack(int $target_type): RedirectResponse
    {
        return redirect()->route('user.appraisals.create', ['target_type' => $target_type])->withInput();
    }

    // 申し込み処理
    public function apply(ApplyRequest $request): RedirectResponse
    {
        \DB::beginTransaction();
        Stripe::setApiKey(config('services.stripe.secret'));

        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        // ポイントが入力されている場合、point_sumから差し引く
        if (!$request->coupon_code && $request->discount_price) {
            UserService::subtractionDiscountPrice($request->discount_price);
        }

        // 決済処理
        $bookbindingUserApply = null;
        $bookbindingUserApplyId = null;
        $contentType = null;
        if ((int) $request->target_type === TargetType::FAMILY->value) {
            $contentType = AppraisalClaim::FAMILY;
        } else {
            $contentType = AppraisalClaim::PERSONAL;
        }

        // 住所から都道府県番号を取得
        if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
            $prefNum = GetPrefNum::getPrefNum($request->address);
            $request->merge([
                'pref_num' => $prefNum,
            ]);
        }

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
                    $family = FamilyService::updateOrCreate($request);
                    $appraisalApply = AppraisalApplyService::create($request, Family::class, $family->id);
                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::FAMILY_BOOKING;
                    }

                    \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new ThanksForFamilyAppraisal($appraisalApply));
                    \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new CompleteForFamilyAppraisal($appraisalApply));

                    //ユーザー自身の場合
                } else {
                    // ホロスコープ修正
                    MyHoroscopeService::update($request);
                    $appraisalApply = AppraisalApplyService::create($request, User::class, auth()->guard('user')->user()->id);
                    \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new ThanksForPersonalAppraisal($appraisalApply));

                    \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new CompleteForPersonalAppraisal($appraisalApply));

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    }
                }

                // 請求データ作成
                AppraisalClaimService::createForCredit(auth()->guard('user')->user()->id, $request, $appraisalApply, $bookbindingUserApplyId, $paymentIntent, $contentType);

                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::warning("決済に失敗しました: {$e->getMessage()}");

                if ($contentType === AppraisalClaim::FAMILY) {
                    return to_route('user.appraisals.create', ['target_type' => TargetType::FAMILY->value])->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
                }
                    return to_route('user.appraisals.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();

            }

            //銀行振込の場合
        } else {
            //家族の場合
            if ((int) $request->target_type === TargetType::FAMILY->value) {
                $family = FamilyService::updateOrCreate($request);
                $appraisalApply = AppraisalApplyService::create($request, Family::class, $family->id);
                //製本の場合
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::FAMILY_BOOKING;
                    $user = auth()->guard('user')->user();
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }

                \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new ThanksForFamilyBankAppraisal($appraisalApply));
                // \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new CompleteForFamilyAppraisal($appraisalApply));
                //ユーザー自身の場合
            } else {
                // ホロスコープ修正
                MyHoroscopeService::update($request);
                $appraisalApply = AppraisalApplyService::create($request, User::class, auth()->guard('user')->user()->id);

                // \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new ThanksForPersonalAppraisal($appraisalApply));
                // dd('a');
                // \Mail::to(GetMail::getMailForApply($appraisalApply))->send(new CompleteForPersonalAppraisal($appraisalApply));

                //製本の場合
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $appraisalApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::PERSONAL_BOOKING;
                    $user = auth()->guard('user')->user();
                    \Mail::to($user->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, $user));
                }
            }

            // 請求データ作成
            $AppraisalClaim = AppraisalClaimService::createForBank(auth()->guard('user')->user()->id, $request, $appraisalApply, $bookbindingUserApplyId, $contentType);
            \DB::commit();
            // メール送信
            $bccMails = GetBccMail::getBccMail();
            \Mail::to(GetMail::getMailForApply($appraisalApply))->bcc($bccMails)->send(new AppraisalReceivedForBank(BankInfo::first(), $AppraisalClaim));
        }

        return to_route('user.appraisals.complete', [
            'appraisal_apply' => $appraisalApply,
            'target_type' => $request->target_type,
        ]);

    }

    // 完了画面
    public function complete(Request $request): View
    {
        $appraisalApply = AppraisalApply::find($request->appraisal_apply);
        return view('user.appraisals.complete', [
            'appraisalApply' => $appraisalApply,
            'target_type' => $request->target_type,
        ]);
    }

    //個人鑑定詳細
    public function show(AppraisalApply $appraisalApply): View
    {
        $appraisalResultData = $this->appraisalApplyService->createAppraisalResultData($appraisalApply);
        return view('user.appraisals.show', [
            'appraisalApply'      => $appraisalApply,
            'degreeData'          => $appraisalResultData['degreeData'],
            'explain'             => $appraisalResultData['explain'],
            'zodaics'             => $appraisalResultData['zodaics'],
            'planets'             => $appraisalResultData['planets'],
            'houses'              => $appraisalResultData['houses'],
            'zodaicsPattern'      => $appraisalResultData['zodaicsPattern'],
            'sabian'              => $appraisalResultData['sabian'],
        ]);
    }

    // サンプルダウンロード
    public function downloadSamplePdf(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download(public_path('pdfs/stellar-blueprint_sample.pdf'));
    }
}

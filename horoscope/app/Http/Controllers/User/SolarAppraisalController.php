<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AppraisalApply;
use App\Models\User;
use App\Services\AppraisalApplyService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appraisal;
use App\Models\Bookbinding;
use App\Http\Requests\User\MySolarHoroscopeController\UpdateRequest;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use App\Repositories\ZodiacRepository;
use App\Services\MyHoroscopeService;
use Modules\Horoscope\Http\Actions\GenerateSolarHoroscopeChartAction;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Family;
use App\Library\GetMail;
use App\Models\BankInfo;
use App\Enums\TargetType;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Library\GetPrefNum;
use App\Services\CouponService;
use App\Mail\User\BookbindingUserApplySolarMailForBank;
use App\Http\Requests\User\SolarAppraisalController\ConfirmRequest;
use App\Models\AppraisalClaim;
use App\Services\AppraisalClaimService;
use App\Services\BookbindingUserApplyService;
use App\Services\FamilyService;
use App\Library\GetBccMail;
use App\Mail\User\CompleteForFamilySolarAppraisal;
use App\Mail\User\CompleteForPersonalSolarAppraisal;
use App\Mail\User\SolarAppraisalReceivedForBank;
use App\Mail\User\ThanksForFamilySolarAppraisal;
use App\Mail\User\ThanksForPersonalSolarAppraisal;
use App\Services\SolarComboboxService;
class SolarAppraisalController extends Controller
{
    public function __construct(
        protected AppraisalApplyService $appraisalApplyService,
        protected GenerateSolarHoroscopeChartAction $generateSolarHoroscopeChartAction,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected SabianPatternRepository $sabianPatternRepository,
    ) {}

    public function index(): View|RedirectResponse
    {
        // 鑑定結果がある場合showへリダイレクト
        $solarAppraisals =  SolarComboboxService::SolarCombobox(auth()->guard('user')->user()->id, User::class);
        $latestSolarAppraisalApply = AppraisalApply::whereHas('user', static function ($query) {
            $query->where('id', auth()->guard('user')->user()->id);
        })->whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->where('reference_type', User::class)
            ->where('solar_return','!=',0)->latest()->first();
        return view('user.solar_appraisals.index', [
            'latestSolarAppraisalApply' => $latestSolarAppraisalApply,
            'solarAppraisals' => $solarAppraisals,
            'solar_appraisal'         => Appraisal::where('is_enabled', true)->where('solar_return', true)->first(),
            'bookbinding'       => Bookbinding::where('is_enabled', true)->where('solar_return', true)->first(),
        ]);
    }

    //show solar appraisal data
    public function show(AppraisalApply $solar_apply): View
    {
        $solarAppraisalResultData = $this->appraisalApplyService->createAppraisalResultData($solar_apply);
        $familyId = $solar_apply->reference_id;
        $family = Family::where('id', $familyId)->first();
        $solarAppraisals =  SolarComboboxService::SolarCombobox($solar_apply->reference_id,$solar_apply->reference_type);
        return view('user.solar_appraisals.show', [
            'solarApply'          => $solar_apply,
            'solarAppraisals'     =>  $solarAppraisals,
            'degreeData'          => $solarAppraisalResultData['degreeData'],
            'explain'             => $solarAppraisalResultData['explain'],
            'zodaics'             => $solarAppraisalResultData['zodaics'],
            'planets'             => $solarAppraisalResultData['planets'],
            'houses'              => $solarAppraisalResultData['houses'],
            'zodaicsPattern'      => $solarAppraisalResultData['zodaicsPattern'],
            'sabian'              => $solarAppraisalResultData['sabian'],
            'family' => $family,
        ]);
    }

    // 会員登録せずに個人鑑定ページの表示
    public function create(Request $request): View|RedirectResponse
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
        return view('user.solar_appraisals.create', [
            'bookbinding' => $bookbinding,
            'solar'   => $solar,
            'totalAmount' => $solar->price + $bookbinding->price + AppraisalClaim::SHIPPING_FEE,
            'request'     => $request,
            'appraisalPrice' => $appraisalPrice,
            'defaultBirthday' => $defaultBirthday,
            'defaultBirthdayTime' => $defaultBirthdayTime,
            'defaultBirthdayPrefectures' => $defaultBirthdayPrefectures,
            'defaultAddress' => $defaultAddress,
        ]);
    }

    //確認画面
    public function confirm(ConfirmRequest $request): View|RedirectResponse
    {
        //合計金額をセッションに保存
        $request->session()->put('total_amount', $request['total_amount']);
        return view('user.solar_appraisals.confirm', [
            'data'        => $request,
            'bookbinding' => Bookbinding::where('is_enabled', true)->where('solar_return',true)->first(),
            'solar'   => Appraisal::where('is_enabled', true)->where('solar_return',true)->first(),
        ]);
    }

    // 入力修正へのリダイレクト
    public function back(): RedirectResponse
    {
        return redirect()->route('user.solar_appraisals.create')->withInput();
    }

    // 申し込み処理
    public function apply(Request $request): RedirectResponse
    {
        $target_type = $request->target_type;
        \DB::beginTransaction();
        Stripe::setApiKey(config('services.stripe.secret'));

        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        // ポイントが入力されている場合、point_sumから差し引く
        if (!$request->coupon_code && $request->discount_price) {
            UserService::subtractionDiscountPrice($request->discount_price);
        }

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
                if ($target_type === TargetType::FAMILY->value) {
                    $contentType = AppraisalClaim::SOLAR_RETURN_FAMILY;
                    // $user = UserService::create($request);
                    $user = auth()->guard('user')->user();
                    $family = FamilyService::updateOrCreate($request);
                    $solarApply = AppraisalApplyService::create($request, Family::class, $family->id);

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::SOLAR_RETURN_FAMILY_BOOKING;
                    }

                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new ThanksForFamilySolarAppraisal($solarApply));
                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new CompleteForFamilySolarAppraisal($solarApply));

                //ユーザー自身の場合
                } else {
                    $contentType = AppraisalClaim::SOLAR_RETURN_PERSONAL;

                    // $user = UserService::createUserAndHoroscope($request);
                    $user = auth()->guard('user')->user();
                    $solarApply = AppraisalApplyService::create($request, User::class, $user->id);
                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new ThanksForPersonalSolarAppraisal($solarApply));

                    \Mail::to(GetMail::getMailForApply($solarApply))->send(new CompleteForPersonalSolarAppraisal($solarApply));

                    //製本の場合
                    if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                        $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                        $bookbindingUserApplyId = $bookbindingUserApply->id;
                        $contentType = AppraisalClaim::SOLAR_RETURN_PERSONAL_BOOKING;
                    }
                }

                // 請求データ作成
                $AppraisalClaim = AppraisalClaimService::createForCredit($user->id, $request, $solarApply, $bookbindingUserApplyId, $paymentIntent, $contentType);

                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::warning("決済に失敗しました: {$e->getMessage()}");
                return to_route('user.solar_appraisals.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            }

        //銀行振込の場合
        } else {
            //家族の場合
            if ((int) $request->target_type === TargetType::FAMILY->value) {
                $contentType = AppraisalClaim::SOLAR_RETURN_FAMILY;
                $user = auth()->guard('user')->user();
                $family = FamilyService::updateOrCreate($request);
                $solarApply = AppraisalApplyService::create($request, Family::class, $family->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::SOLAR_RETURN_FAMILY_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplySolarMailForBank($bookbindingUserApply, $user));
                }
            //ユーザー自身の場合
            } else {
                $contentType = AppraisalClaim::SOLAR_RETURN_PERSONAL;
                // $user = UserService::createUserAndHoroscope($request);
                $user = auth()->guard('user')->user();
                $solarApply = AppraisalApplyService::create($request, User::class, $user->id);
                if ((int) $request->is_bookbinding === Bookbinding::BOOKBINDING) {
                    $bookbindingUserApply = BookbindingUserApplyService::create($request, $solarApply);
                    $bookbindingUserApplyId = $bookbindingUserApply->id;
                    $contentType = AppraisalClaim::SOLAR_RETURN_PERSONAL_BOOKING;
                    \Mail::to($user->email)->send(new BookbindingUserApplySolarMailForBank($bookbindingUserApply, $user));
                }

            }
            // 請求データ作成
            $AppraisalClaim = AppraisalClaimService::createForBank($user->id, $request, $solarApply, $bookbindingUserApplyId, $contentType);
            // コミットとメール送信
            \DB::commit();

            $bccMails = GetBccMail::getBccMail();
            \Mail::to(GetMail::getMailForApply($solarApply))->bcc($bccMails)->send(new SolarAppraisalReceivedForBank(BankInfo::first(), $AppraisalClaim));
        }


        // $bccMails = GetBccMail::getBccMail();
        // \Mail::to(GetMail::getMailForApply($solarApply))->bcc($bccMails)->send(new AppraisalReceivedForBank(BankInfo::first(), $AppraisalClaim));
        return to_route('user.solar_appraisals.complete', [
            'solarApply' => $solarApply,
            'target_type' => $request->target_type,
        ]);

    }

    public function complete(Request $request): View|RedirectResponse
    {
        $solarApply = AppraisalApply::find($request->solarApply);
        return view('user.solar_appraisals.complete', [
            'solarApply' => $solarApply,
            'target_type' => $request->target_type,
        ]);
    }
    public function downloadSolarSamplePdf(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download(public_path('pdfs/solar-return_sample.pdf'));
    }
}

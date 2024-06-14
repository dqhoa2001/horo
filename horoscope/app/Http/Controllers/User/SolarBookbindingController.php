<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\SolarApplyService;
use App\Services\SolarClaimService;
use Illuminate\Http\Request;
use App\Models\Bookbinding;
use App\Models\SolarApply;
use App\Models\Solar;
use App\Models\Appraisal;
use Illuminate\View\View;
use App\Http\Requests\User\SolarBookbindingController\ConfirmRequest;
use App\Http\Requests\User\SolarBookbindingController\ApplyRequest;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Services\CouponService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use App\Library\GetBccMail;
use App\Library\GetPrefNum;
use App\Models\SolarClaim;
use App\Services\BookbindingUserSolarApplyService;
use App\Mail\User\BookbindingBankInfoMailForBank;
use App\Mail\User\BookbindingUserApplyMailForBank;
use App\Models\BankInfo;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Services\BookbindingUserApplyService;
use App\Services\AppraisalClaimService;

class SolarBookbindingController extends Controller
{
    public function __construct(
        protected SolarClaimService $solarClaimService,
        protected SolarApplyService $solarApplyService,
    ) {}

    // 製本申し込みの表示
    public function create(): View
    {
        $user = auth()->guard('user')->user();
        //get family have solar appraisal
        $familiesWithAppraisalApplies = $user->familiesWithAppraisalApplies();
        $personalSolarAppraisals = $user->appraisalApplies()->where('solar_return','!=',0)->whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->orderBy('id', 'desc')->get();
        $familySolarAppraisals = $user->families->mapWithKeys(function ($family) {
            $solarAppraisals = $family->appraisalApplies()->where('solar_return', '!=', 0)->orderBy('id', 'asc')->get();
            return [$family->id => $solarAppraisals];
        });
        // dd($familySolarAppraisals);
        return view('user.solar_bookbindings.create2', [
            'bookbinding'                       => Bookbinding::where('solar_return',true)->where('is_enabled', true)->first(),
            'personalSolarAppraisals'           => $personalSolarAppraisals,
            'familySolarAppraisals'             => $familySolarAppraisals,
            'user'                              => $user,
            'familiesWithAppraisalApplies'      => $familiesWithAppraisalApplies
        ]);
    }

    public function confirm(ConfirmRequest $request)
    {
        $user = auth()->guard('user')->user();
        $data = $request->substitutable();
        if((int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && !\array_key_exists('coupon_code', $data) || (int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && $data['coupon_code'] === null) {
            return redirect()->route('user.bookbindings.create')->withInput()->with('priceError', true);
        }
        $data['select_appraisal_applies_id'] =[];
        //get choosen appraisal apply id
        if(isset( $data['solar_appraisal_apply_ids'])){
            $data['select_appraisal_applies_id'] = array_merge($data['select_appraisal_applies_id'], $data['solar_appraisal_apply_ids']);
        }
        if(isset(  $data['family_solar_appraisal_apply_ids'])){
            $data['select_appraisal_applies_id'] = array_merge($data['select_appraisal_applies_id'], $data['family_solar_appraisal_apply_ids']);
        }
        $data['select_appraisal_applies'] = AppraisalApply::whereIn('id',$data['select_appraisal_applies_id'])->get();

        // $data['select_appraisal_applies']の順番を$data['appraisal_apply_ids']の順番に並び替え
        $data['select_appraisal_applies'] = $data['select_appraisal_applies']->sortBy(static function ($solarAppraisalApply) use ($data) {
            return array_search($solarAppraisalApply->id,  $data['select_appraisal_applies_id'], true);
        });
        $data['pdf_types'] = [];
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            // $dataの中の「pdf_type-*」の*の値が$appraisalApplyのidと一致するものを取得
            foreach ($data as $key => $value) {
                if (strpos($key, 'pdf_type-') !== false) {
                    $id = str_replace('pdf_type-', '', $key);
                    if ((int) $id === $appraisalApply->reference->id) {
                        $data['pdf_types'][$appraisalApply->id] = $value;
                    }
                }
            }
        }
        // dd( $data);
        //合計金額をセッションに保存
        $request->session()->put('discount_price', $data['discount_price']);
        //割引金額をセッションに保存
        $request->session()->put('total_amount', $data['total_amount']);
        return view('user.solar_bookbindings.confirm', [
            'data' => $data,
            'bookbinding' => Bookbinding::where('solar_return',true)->where('is_enabled', true)->first(),
            'solar_appraisal'   => Appraisal::where('solar_return',true)->where('is_enabled', true)->first(),
        ]);
    }

    // 確認画面から、修正して戻る
    public function back(Request $request): RedirectResponse
    {
        // dd($request->solar_appraisal_apply_id);
        $solarAppraisalApply = AppraisalApply::where('id', $request->select_appraisal_applies_id)->first();
        return to_route('user.solar_bookbindings.create', $solarAppraisalApply)->withInput();
    }

    // 製本申し込み処理
    public function apply(ApplyRequest $request): RedirectResponse
    {
        //  dd($request->all());
        $user = auth()->guard('user')->user();
        $solarAppraisalApplies = AppraisalApply::whereIn('id', $request->select_appraisal_applies_id)->get();
        // dd($solarAppraisalApplies);
        \DB::beginTransaction();
        Stripe::setApiKey(config('services.stripe.secret'));
        // バックポイントの付与
        if ($request->coupon_code) {
            CouponService::updateBackPoint($request->coupon_code);
        }

        // クーポンが入力されている場合、point_sumから差し引く
        if (!$request->coupon_code && $request->discount_price) {
            UserService::subtractionDiscountPrice($request->discount_price);
        }

        // ランダムな文字列を生成
        $bulkBindingKey = \Str::random(10);

        // 住所から都道府県番号を取得
        $prefNum = GetPrefNum::getPrefNum($request->address);
        $request->merge([
            'pref_num' => $prefNum,
        ]);

        // 決済処理
        //クレジット決済の場合
        if ((int) $request->payment_type === AppraisalClaim::CREDIT) {

            // dd($request->payment_type);
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

                foreach ($solarAppraisalApplies as $solarAppraisalApply) {
                    //製本の申し込み処理
                    $bulkBindingCount = \count($solarAppraisalApplies);
                    // dd($bulkBindingCount);
                    $bookbindingUserSolarApply = BookbindingUserApplyService::createForSolarBookbinding($request, $solarAppraisalApply, $bulkBindingKey, $bulkBindingCount);
                    // dd($bookbindingUserSolarApply);
                    $contentType = AppraisalClaim::SOLAR_RETURN_BOOKING;

                    // 請求データ作成
                    AppraisalClaimService::createForCredit(auth()->guard('user')->user()->id, $request, $solarAppraisalApply, $bookbindingUserSolarApply->id, $paymentIntent, $contentType);
                }

                \DB::commit();
            } catch (\Stripe\Exception\CardException $e) {
                // エラーハンドリング: ログ記録
                \Log::error("支払いに失敗しました。stripeのエラー" . $e->getMessage());
                return to_route('user.solar_bookbindings.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::error("支払いに失敗しました。General Error: {$e->getMessage()}");
                return to_route('user.solar_bookbindings.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            }

            //銀行振込の場合
        } else {
            //製本の申し込み処理
            foreach ($solarAppraisalApplies as $solarAppraisalApply) {
                //製本の申し込み処理
                $bulkBindingCount = \count($solarAppraisalApplies);
                $bookbindingUserSolarApply = BookbindingUserApplyService::createForSolarBookbinding($request, $solarAppraisalApply, $bulkBindingKey, $bulkBindingCount);
                $contentType = AppraisalClaim::SOLAR;

                // 請求データ作成
                $solarAppraisalClaim = AppraisalClaimService::createForBank(auth()->guard('user')->user()->id, $request, $solarAppraisalApply, $bookbindingUserSolarApply->id, $contentType);

                // 最後の申し込みの場合、メール送信
                if ($solarAppraisalApply->id === $solarAppraisalApplies->last()->id) {
                    \Mail::to(auth()->guard('user')->user()->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserSolarApply, auth()->guard('user')->user()));

                    $bccMails = GetBccMail::getBccMail();
                    \Mail::to(auth()->guard('user')->user()->email)->bcc($bccMails)->send(new BookbindingBankInfoMailForBank(BankInfo::first(), $solarAppraisalClaim));
                }
            }

            \DB::commit();
        }

        return to_route('user.solar_bookbindings.complete', [
            'payment_type' => $request->payment_type,
        ]);
    }

    // 製本申し込み完了
    public function complete(Request $request): View
    {
        return view('user.solar_bookbindings.complete', [
            'payment_type' => $request->payment_type,
        ]);
    }

    // 表紙イメージのダウンロード
    public function downloadSamplePdf(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return response()->download(public_path('pdfs/stellar-blueprint_sample_cover.pdf'));
    }

    // 表紙イメージのダウンロード（お客様のお名前入り）
    public function downloadCoverPdf(int $design, string $name1, string $name2): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $pdfData = $this->solarApplyService->makeCoverImage($design, $name1, $name2);
        return response()->download($pdfData['pdfFilePath'], $pdfData['fileName']);
    }
}

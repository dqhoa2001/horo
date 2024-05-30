<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\SolarApplyService;
use App\Services\SolarClaimService;
use Illuminate\Http\Request;
use App\Models\Bookbinding;
use App\Models\SolarApply;
use App\Models\Solar;
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

        // 最新の個人鑑定申し込みを取得
        $solarPersonalAppraisal = $user->solarApplies()->whereHas('solarClaim', static function ($query) {
            $query->where('is_paid', true);
        })->orderBy('id', 'desc')->get();
        // dd($personalAppraisal);
        // 家族の個人鑑定を取得

        //個人鑑定製本済数
        $personalBookbindingUserAppliesCount = 0;
        foreach ($user->appraisalApplies as $appraisalApply) {
            if (isset($appraisalApply->bookbindingUserApplies)) {
                foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                    $personalBookbindingUserAppliesCount += 1;
                }
            }
        }
        // dd($solarPersonalAppraisal);
        return view('user.solar_bookbindings.create', [
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'solarPersonalAppraisal' => $solarPersonalAppraisal,
            'personalBookbindingUserAppliesCount' => $personalBookbindingUserAppliesCount,
        ]);
    }

    public function confirm(ConfirmRequest $request)
    {
        $data = $request->substitutable();
        // dd($data);
        if((int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && !\array_key_exists('coupon_code', $data) || (int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && $data['coupon_code'] === null) {
            return redirect()->route('user.bookbindings.create')->withInput()->with('priceError', true);
        }

        $data['select_appraisal_applies'] = SolarApply::whereIn('id', $data['solar_appraisal_apply_ids'])->get();
        //  dd(  $data['select_appraisal_applies']);
        // $data['select_appraisal_applies']の順番を$data['appraisal_apply_ids']の順番に並び替え
        $data['select_appraisal_applies'] = $data['select_appraisal_applies']->sortBy(static function ($solarAppraisalApply) use ($data) {
            return array_search($solarAppraisalApply->id, $data['solar_appraisal_apply_ids'], true);
        });
        $data['select_appraisal_applies'];
        $data['pdf_types'] = [];
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            // $dataの中の「pdf_type-*」の*の値が$appraisalApplyのidと一致するものを取得
            foreach ($data as $key => $value) {
                if (strpos($key, 'pdf_type-') !== false) {
                    $id = str_replace('pdf_type-', '', $key);
                    if ((int) $id === $appraisalApply->id) {
                        $data['pdf_types'][$appraisalApply->id] = $value;
                    }
                }
            }
        }

        //合計金額をセッションに保存
        $request->session()->put('discount_price', $data['discount_price']);
        //割引金額をセッションに保存
        $request->session()->put('total_amount', $data['total_amount']);

        return view('user.solar_bookbindings.confirm', [
            'data' => $data,
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'solar_appraisal'   => Solar::where('is_enabled', true)->first(),
        ]);
    }

    // 確認画面から、修正して戻る
    public function back(Request $request): RedirectResponse
    {
        // dd($request->solar_appraisal_apply_id);
        $solarAppraisalApply = Solarapply::where('id', $request->solar_appraisal_apply_id)->first();
        return to_route('user.solar_bookbindings.create', $solarAppraisalApply)->withInput();
    }

    // 製本申し込み処理
    public function apply(ApplyRequest $request): RedirectResponse
    {
        $user = auth()->guard('user')->user();
        $solarAppraisalApplies = SolarApply::whereIn('id', $request->solar_appraisal_apply_ids)->get();

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

                foreach ($solarAppraisalApplies as $solarAppraisalApply) {
                    //製本の申し込み処理
                    $bulkBindingCount = \count($solarAppraisalApplies);
                    $bookbindingUserSolarApply = BookbindingUserSolarApplyService::createForBookbinding($request, $solarAppraisalApply, $bulkBindingKey, $bulkBindingCount);
                    $contentType = SolarClaim::BOOKING;

                    // 請求データ作成
                    SolarClaimService::createForCredit(auth()->guard('user')->user()->id, $request, $solarAppraisalApply, $bookbindingUserSolarApply->id, $paymentIntent, $contentType);
                }

                \DB::commit();
            } catch (\Stripe\Exception\CardException $e) {
                // エラーハンドリング: ログ記録
                \Log::error("支払いに失敗しました。stripeのエラー" . $e->getMessage());
                return to_route('user.bookbindings.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
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
                $bookbindingUserSolarApply = BookbindingUserSolarApplyService::createForBookbinding($request, $solarAppraisalApply, $bulkBindingKey, $bulkBindingCount);
                $contentType = SolarClaim::BOOKING;

                // 請求データ作成
                $solarAppraisalClaim = SolarClaimService::createForBank(auth()->guard('user')->user()->id, $request, $solarAppraisalApply, $bookbindingUserSolarApply->id, $contentType);

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

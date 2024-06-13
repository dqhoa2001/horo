<?php

namespace App\Http\Controllers\User;

use Stripe\Stripe;
use App\Library\GetMail;
use App\Models\BankInfo;
use App\Models\Appraisal;
use Illuminate\Http\File;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use App\Library\GetBccMail;
use App\Library\GetPrefNum;
use App\Models\Bookbinding;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Services\CouponService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\AppraisalApplyService;
use App\Services\AppraisalClaimService;
use App\Mail\User\AppraisalReceivedForBank;
use App\Mail\User\BookbindingUserApplyMail;
use App\Services\BookbindingUserApplyService;
use App\Mail\User\BookbindingBankInfoMailForBank;
use App\Mail\User\BookbindingUserApplyMailForBank;
use App\Http\Requests\User\BookbindingController\ApplyRequest;
use App\Http\Requests\User\BookbindingController\ConfirmRequest;

class BookbindingController extends Controller
{
    public function __construct(
        protected AppraisalClaimService $appraisalClaimService,
        protected AppraisalApplyService $appraisalApplyService,
    ) {}

    // 製本申し込みの表示
    public function create(): View
    {
        $user = auth()->guard('user')->user();

        // 最新の個人鑑定申し込みを取得
        $personalAppraisal = $user->appraisalApplies()->where('solar_return',0)->whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->orderBy('id', 'desc')->first();

        // 家族の個人鑑定を取得
        $familyAppraisals = $user->families->map(static function ($family) {
            return $family->appraisalApplies()->where('solar_return',0)->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->orderBy('id', 'desc')->first();
        })->filter(static function ($family) {
            return null !== $family;
        });

        //個人鑑定製本済数
        $personalBookbindingUserAppliesCount = 0;
        foreach ($user->appraisalApplies as $appraisalApply) {
            if (isset($appraisalApply->bookbindingUserApplies)) {
                foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                    $personalBookbindingUserAppliesCount += 1;
                }
            }
        }

        //家族の個人鑑定製本済数
        $familyBookbindingUserAppliesCount = [];
        foreach ($user->families as $family) {
            $count = 0;
            if (isset($family->appraisalApplies)) {
                foreach ($family->appraisalApplies as $appraisalApply) {
                    if (isset($appraisalApply->bookbindingUserApplies)) {
                        foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                            $count += 1;
                        }
                    }
                }
            }
            $familyBookbindingUserAppliesCount = $familyBookbindingUserAppliesCount + [$family->id => $count];
        }

        return view('user.bookbindings.create', [
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'personalAppraisal' => $personalAppraisal,
            'familyAppraisals' => $familyAppraisals,
            'personalBookbindingUserAppliesCount' => $personalBookbindingUserAppliesCount,
            'familyBookbindingUserAppliesCount' => $familyBookbindingUserAppliesCount,
        ]);
    }

    /**
     * リクエストに基づいてViewまたはRedirectResponseを返す。
     *
     * @param ConfirmRequest $request
     *
     * @return View|RedirectResponse
     */
    // 製本の確認
    public function confirm(ConfirmRequest $request)
    {
        $data = $request->substitutable();

        if((int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && !\array_key_exists('coupon_code', $data) || (int) $data['discount_price'] === 0 && (int) $data['total_amount'] === 0 && $data['coupon_code'] === null) {
            return redirect()->route('user.bookbindings.create')->withInput()->with('priceError', true);
        }

        $data['select_appraisal_applies'] = AppraisalApply::whereIn('id', $data['appraisal_apply_ids'])->get();
        // $data['select_appraisal_applies']の順番を$data['appraisal_apply_ids']の順番に並び替え
        $data['select_appraisal_applies'] = $data['select_appraisal_applies']->sortBy(static function ($appraisalApply) use ($data) {
            return array_search($appraisalApply->id, $data['appraisal_apply_ids'], true);
        });

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

        return view('user.bookbindings.confirm', [
            'data' => $data,
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'appraisal'   => Appraisal::where('is_enabled', true)->first(),
        ]);
    }

    // 確認画面から、修正して戻る
    public function back(Request $request): RedirectResponse
    {
        $appraisalApply = AppraisalApply::where('id', $request->appraisal_apply_id)->first();
        return to_route('user.bookbindings.create', $appraisalApply)->withInput();
    }

    // 製本申し込み処理
    public function apply(ApplyRequest $request): RedirectResponse
    {
        $user = auth()->guard('user')->user();
        $appraisalApplies = AppraisalApply::whereIn('id', $request->appraisal_apply_ids)->get();

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

                foreach ($appraisalApplies as $appraisalApply) {
                    //製本の申し込み処理
                    $bulkBindingCount = \count($appraisalApplies);
                    $bookbindingUserApply = BookbindingUserApplyService::createForBookbinding($request, $appraisalApply, $bulkBindingKey, $bulkBindingCount);
                    $contentType = AppraisalClaim::BOOKING;

                    // 請求データ作成
                    AppraisalClaimService::createForCredit(auth()->guard('user')->user()->id, $request, $appraisalApply, $bookbindingUserApply->id, $paymentIntent, $contentType);
                }

                \DB::commit();
            } catch (\Stripe\Exception\CardException $e) {
                // エラーハンドリング: ログ記録
                \Log::error("支払いに失敗しました。stripeのエラー" . $e->getMessage());
                return to_route('user.bookbindings.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            } catch (\Exception $e) {
                \DB::rollback();
                \Log::error("支払いに失敗しました。General Error: {$e->getMessage()}");
                return to_route('user.bookbindings.create')->with('flash_alert', '決済に失敗しました。違うカードをお試しするか、銀行振込をご指定ください。')->withInput();
            }

            //銀行振込の場合
        } else {
            //製本の申し込み処理
            foreach ($appraisalApplies as $appraisalApply) {
                //製本の申し込み処理
                $bulkBindingCount = \count($appraisalApplies);
                $bookbindingUserApply = BookbindingUserApplyService::createForBookbinding($request, $appraisalApply, $bulkBindingKey, $bulkBindingCount);
                $contentType = AppraisalClaim::BOOKING;

                // 請求データ作成
                $AppraisalClaim = AppraisalClaimService::createForBank(auth()->guard('user')->user()->id, $request, $appraisalApply, $bookbindingUserApply->id, $contentType);

                // 最後の申し込みの場合、メール送信
                if ($appraisalApply->id === $appraisalApplies->last()->id) {
                    \Mail::to(auth()->guard('user')->user()->email)->send(new BookbindingUserApplyMailForBank($bookbindingUserApply, auth()->guard('user')->user()));

                    $bccMails = GetBccMail::getBccMail();
                    \Mail::to(auth()->guard('user')->user()->email)->bcc($bccMails)->send(new BookbindingBankInfoMailForBank(BankInfo::first(), $AppraisalClaim));
                }
            }

            \DB::commit();
        }

        return to_route('user.bookbindings.complete', [
            'payment_type' => $request->payment_type,
        ]);
    }

    // 製本申し込み完了
    public function complete(Request $request): View
    {
        return view('user.bookbindings.complete', [
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
        $pdfData = $this->appraisalApplyService->makeCoverImage($design, $name1, $name2);
        return response()->download($pdfData['pdfFilePath'], $pdfData['fileName']);
    }
}

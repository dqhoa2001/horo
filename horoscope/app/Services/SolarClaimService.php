<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\File;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Models\SolarApply;
use App\Models\SolarClaim;
use App\Models\BookbindingUserApply;
use Illuminate\Database\Eloquent\Builder;

class SolarClaimService
{
    public function __construct(
        protected SolarApplyService $solarApplyService,
    ) {
    }

    // 検索
    public static function search(array $input): Builder
    {
        $query = SolarClaim::with(['user']);

        if (isset($input['general']) || isset($input['influencer']) || isset($input['withdraw'])) {
            $query->whereHas('user', static function ($query) use ($input) {
                $query->where(static function ($query) use ($input) {
                    if (isset($input['general'])) {
                        $query->orWhere('member_type', User::GENERAL)->where('deleted_at', null);
                    }

                    if (isset($input['influencer'])) {
                        $query->orWhere('member_type', User::INFLUENCER)->where('deleted_at', null);
                    }

                    if (isset($input['withdraw'])) {
                        $query->orWhereNotNull('deleted_at');
                    }
                });
            });
        }

        if (isset($input['searchEmail']) && (int) $input['searchEmail'] !== User::ALL) {
            $query->whereHas('user', static function ($query) use ($input) {
                $query->where('email', 'like', '%' . $input['searchEmail'] . '%');
            });
        }
        if (isset($input['searchName'])) {
            $query->whereHas('user', static function ($query) use ($input) {
                $query->where('name1', 'like', '%' . $input['searchName'] . '%')->orWhere('name2', 'like', '%' . $input['searchName'] . '%');
            });
        }

        return $query;
    }

    //請求履歴登録処理
    public static function createForCredit(int $userId, Request $request, SolarApply $solarApply, ?int $bookbindingUserApplyId, PaymentIntent $paymentIntent, int $contentType): SolarClaim
    {
        $SolarClaim = SolarClaim::create([
            'user_id'            => $userId,
            'Solar_apply_id' => $solarApply->id,
            'bookbinding_user_apply_id' => $bookbindingUserApplyId,
            'payment_intent_id'  => $paymentIntent->id,
            'price'              => $paymentIntent->amount,
            'coupon_code'        => $request->coupon_code ?? null,
            'discount_price'     => $request->discount_price ?? 0,
            'purchase_date'      => today(),
            'payment_type'       => $request->payment_type,
            'content_type'       => $contentType,
            'is_paid'            => true,
            'paid_at'            => today(),
        ]);

        return $SolarClaim;
    }

    //請求履歴登録処理
    public static function createForBank(int $userId, Request $request, SolarApply $solarApply, ?int $bookbindingUserApplyId, int $contentType): SolarClaim
    {
        $solarClaim = SolarClaim::create([
            'user_id'            => $userId,
            'Solar_apply_id' => $solarApply->id,
            'bookbinding_user_apply_id' => $bookbindingUserApplyId,
            'price'              => $request->total_amount,
            'coupon_code'        => $request->coupon_code ?? null,
            'discount_price'     => $request->discount_price ?? 0,
            'purchase_date'      => today(),
            'payment_type'       => $request->payment_type,
            'content_type'       => $contentType,
            'is_paid'            => false,
        ]);

        return $solarClaim;
    }

    // 製本pdfの作成→ftpサーバーにアップロード→直送apiリクエスト
    public function bookbindingDelivery(BookbindingUserApply $bookbindingUserApply): string
    {
        $pdfData = $this->solarApplyService->makeBook($bookbindingUserApply);
        // ftpサーバーにアップロード
        $file = new File($pdfData['pdfFilePath']);
        $fileName = $pdfData['fileName'];
        $dirName = config('services.seichoku.ftp_dir');
        \Storage::disk('ftp')->putFileAs($dirName, $file, $fileName);

        // ファイル名を更新
        $bookbindingUserApply->update([
            'file_name' => $fileName,
        ]);

        // apiリクエスト
        $response = BookbindingUserApplyService::shippingBook($bookbindingUserApply, $dirName, $fileName);

        return $response;
    }

    public function bulkBookbindingDelivery(BookbindingUserApply $bookbindingUserApply): void
    {
        $shippingData = [
            'addr01' => $bookbindingUserApply->address,
            'addr02' => $bookbindingUserApply->building,
            'zip01' => substr($bookbindingUserApply->post_number, 0, 3),
            'zip02' => substr($bookbindingUserApply->post_number, 3, 4),
            'name' => $bookbindingUserApply->name,
            'tel' => $bookbindingUserApply->tel,
            'email' => $bookbindingUserApply->solarClaim->user->email,
        ];
        $bulkShippingFileData = [];
        $sameBookbindingUserApplies = BookbindingUserApply::where('bulk_binding_key', $bookbindingUserApply->bulk_binding_key)->get();
        foreach ($sameBookbindingUserApplies as $sameBookbindingUserApply) {
            // 製本の作成
            $pdfData = $this->solarApplyService->makeBook($sameBookbindingUserApply);

            // ftpサーバーにアップロード
            $file = new File($pdfData['pdfFilePath']);
            $fileName = $pdfData['fileName'];
            $dirName = config('services.seichoku.ftp_dir');
            \Storage::disk('ftp')->putFileAs($dirName, $file, $fileName);

            // ファイル名を更新
            $sameBookbindingUserApply->update([
                'file_name' => $fileName,
            ]);

            // bulkShippingFileDataにデータを追加
            $bulkShippingFileData[] = [
                'fileName' => $fileName,
                'dirName' => $dirName,
            ];

            // 支払い状態を更新
            $sameBookbindingUserApply->solarClaim->update([
                'is_paid' => true,
            ]);
        }
        BookbindingUserApplyService::bulkShippingBook($bulkShippingFileData, $shippingData);
    }
}

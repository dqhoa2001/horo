<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Library\GetBccMail;
use Illuminate\Http\Request;
use App\Models\AppraisalClaim;
use App\Mail\Admin\ShippingError;
use App\Http\Controllers\Controller;
use App\Models\BookbindingUserApply;
use App\Mail\User\BookbindingUserApplyMail;
use App\Mail\User\BookbindingUserApplyMailForBankComplete;

class BookbindingController extends Controller
{
    public function bookbindingResult(Request $request): void
    {
        // logに出力
        $response = json_decode(base64_decode($request->param, true), true);
        \Log::info('製本直送APIのレスポンス（bookbindingResult）', ['response' => $response]);
        if ($response['result'] !== 'success') {
            \Log::alert('製本直送APIのレスポンス（bookbindingResult）', ['response' => $response]);

            // 本番環境のみエラーメールを送信
            if (app()->isProduction()) {
                $firstErrorInfo = $response['errInfo'][0]['err_message'];
                // サイト運営者にメールを送信（保守フェーズになってから）
                \Mail::to('info@hoshino-mai.org')->send(new ShippingError($firstErrorInfo));
            }
            
            return;
        }
        
        $firstBookbindingUserApply = '';
        foreach ($response['resultInfo']['list'] as $resultInfo) {
            $bookbindingUserApply = BookbindingUserApply::where('file_name', $resultInfo['file_name'])->first();
            \Log::info('製本直送APIのレスポンス（bookbindingResult）', ['bookbindingUserApply' => $bookbindingUserApply]);
            $bookbindingUserApply->update([
                'order_id' => $resultInfo['order_id'],
                'scheduled_shipping_date' => $response['resultInfo']['scheduled_shipping_date'],
                'purchase_amount' => $response['resultInfo']['purchase_amount'],
            ]);

            if ($firstBookbindingUserApply === '') {
                $firstBookbindingUserApply = $bookbindingUserApply;
            }
        }

        // $bookbindingUserApply = $firstBookbindingUserApply;
        $user = $firstBookbindingUserApply->appraisalClaim->user;
        $paymentType = $firstBookbindingUserApply->appraisalClaim->payment_type;
        // $appraisalApply = $firstBookbindingUserApply->appraisalClaim->appraisalApply;
        // \Log::info('appraisalApply:', ['appraisalApply' => $appraisalApply]);
        if ($paymentType === AppraisalClaim::CREDIT) {
            \Mail::to($user->email)->send(new BookbindingUserApplyMail($firstBookbindingUserApply, $user));
        }
        if ($paymentType === AppraisalClaim::BANK) {
            $bccMails = GetBccMail::getBccMail();
            \Mail::to($user->email)->bcc($bccMails)->send(new BookbindingUserApplyMailForBankComplete($firstBookbindingUserApply, $user));
        }
    }

    public function deliveryInfo(Request $request): void
    {
        // logに出力
        $response = json_decode(base64_decode($request->param, true), true);
        \Log::info('製本直送APIのレスポンス（deliveryInfo）', ['response' => $response]);
        
    }
}

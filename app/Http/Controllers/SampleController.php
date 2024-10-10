<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\View\View;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SampleController extends Controller
{
    // stripeのテスト画面を表示
    public function stripe(Request $request): View
    {
        $primaryLanguage = $request->language ?? 'en';
            
        // ブラウザに登録している言語に設定
        if ($request->language === null) {
            // Accept-Languageヘッダーを取得
            $acceptLanguage = $request->header('Accept-Language');
            
            // Accept-Languageヘッダーは、複数の言語とその品質値を含むことができるので、
            // 最初の言語コードだけを取得する
            $browserLanguage = explode(',', $acceptLanguage)[0];
            $primaryLanguage = explode('-', $browserLanguage)[0]; // "en-US"のような形式の場合、"en"だけを取得する
            
            // Accept-Languageヘッダーが空の場合や、en, ja, zhのいずれでもない場合は、enを設定する
            if ($primaryLanguage === '') {
                $primaryLanguage = 'en';
            } elseif (!\in_array($primaryLanguage, ['en', 'ja', 'zh'], true)) {
                $primaryLanguage = 'en';
            }
        }
        
        // ロケールを設定
        app()->setLocale($primaryLanguage);
        
        // 基本価格を設定
        $baseAmount = 8800;
        
        return view('samples.stripes.index', [
            'primaryLanguage' => $primaryLanguage,
            'baseAmount' => $baseAmount,
        ]);
    }
    
    // stripeのcreate-payment-intentを実行
    public function createPaymentIntent(): JsonResponse
    {
        // stripeのAPIキーを取得
        Stripe::setApiKey(config('services.stripe.secret'));
        
        // 基本価格を設定
        $baseAmount = 8800;

        try {
            // stripeのcreate-payment-intentを実行
            $paymentIntent = PaymentIntent::create([
                'amount' => $baseAmount,
                'currency' => 'jpy',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
            
            // stripeのcreate-payment-intentの結果を返す
            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'PaymentIntentの作成に失敗しました。',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    // stripeのcheckoutを実行
    public function checkout(): View
    {
        return view('samples.stripes.checkout');
    }
}

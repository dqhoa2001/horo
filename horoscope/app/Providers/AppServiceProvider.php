<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * NGROKによって生成されたURLを使うと、CSSやJavaScriptが無効になる。強制的にHTTPSに合わせる
         * https://biz.addisteria.com/https-hgrok-error/
         */
        // if(config('app.env') === 'local'){
        //     \URL::forceScheme('https');
        // }

        // このルールは、テキストの全角文字数が指定された最大値以下であるかを検証します。
        // 全角文字は1文字としてカウントされ、mb_strlen関数を使用して文字数を計済みます。
        \Validator::extend('max_mb', static function ($attribute, $value, $parameters, $validator) {
            // パラメータから最大文字数を取得し、指定されていない場合は0をデフォルト値とします。
            $max = isset($parameters[0]) ? (int) $parameters[0] : 0;

            // 全角文字を1文字としてカウント
            $length = mb_strlen($value, 'UTF-8');

            // 実際の文字数が指定された最大値以下であればtrue、そうでなければfalseを返します。
            return $length <= $max;
        });

        // このルールは、電話番号の形式が正しいかを検証します。
        \Validator::extend('custom_phone', static function ($attribute, $value, $parameters, $validator) {
            // 「090」「070」「080」で始まる11桁の電話番号のチェック
            if (preg_match('/^(090|080|070)\d{8}$/', $value)) {
                return true;
            }

            // 「0267」で始まる10桁の電話番号のチェック
            if (preg_match('/^0267\d{6}$/', $value)) {
                return true;
            }

            // 「03」で始まる10桁の電話番号のチェック
            if (preg_match('/^03\d{8}$/', $value)) {
                return true;
            }
            
            // 「090」「070」「080」「0267」「03」以外で始まる、10桁から12桁の電話番号のチェック
            // 「090」「070」「080」「0267」「03」で始まる場合には、この条件にマッチしないようにする
            if (preg_match('/^0(?!90|80|70|267|3)\d{9,11}$/', $value)) {
                return true;
            }

            // 上記のいずれにも該当しない場合は不正とする
            return false;
        });

        // エラーメッセージの置き換え
        \Validator::replacer('custom_phone', static function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, '正しい電話番号を入力してください');
        });

        // このルールは、￥・＠・`・<>・,などの特殊文字が含まれていないかを検証します。
        \Validator::extend('exclude_special_chars', static function ($attribute, $value, $parameters, $validator) {
            // 禁止されている特定の記号：￥、＠、バッククォート(`)、<、>、カンマ(,)
            if (preg_match('/[￥＠`<>，@]+/u', $value)) { // Unicodeフラグを使用し、正しいエスケープを行い、半角の「@」を含めます
                // 禁止されている記号が含まれている場合はfalseを返し、バリデーションを失敗させる
                return false;
            }

            // 禁止されている記号が含まれていなければtrueを返す
            return true;
        });

        // エラーメッセージの置き換え
        \Validator::replacer('exclude_special_chars', static function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, '特殊文字（￥、＠、バッククォート(`)、<、>、カンマ(,)）は使用できません');
        });

        // このルールは、入力された住所が日本であるかを検証します。
        \Validator::extend('is_japan_address', static function ($attribute, $value, $parameters, $validator) {
            // google map apiで国を取得
            $country = '';
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($value) . "&key=" . config('app.google_map_api_key');
            try {
                $json = file_get_contents($url);
            } catch (\Exception $e) {
                \Log::error('Error fetching data from Google Maps API: ' . $e->getMessage());
                return false;
            }

            $obj = json_decode($json, true);
            if ($obj['status'] === 'OK') {
                foreach ($obj['results'][0]['address_components'] as $addressComponent) {
                    if (\in_array('country', $addressComponent['types'], true)) {
                        $country = $addressComponent['short_name'];
                        break;
                    }
                }
            }

            // 国が日本であればtrueを返し、そうでなければfalseを返します。
            return $country === 'JP';
        });

        // エラーメッセージの置き換え
        \Validator::replacer('is_japan_address', static function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, '日本の住所を入力してください');
        });

        // selectボタンで送られてくる値が「選択してください」という場合
        \Validator::extend('select_check', static function ($attribute, $value, $parameters, $validator) {
            return $value !== '選択してください';
        });

        // selecetボタンのエラーメッセージの書き換え
        \Validator::replacer('select_check', static function ($message, $attribute, $rule, $parameters) {
            return '選択してください';
        });
    }
}

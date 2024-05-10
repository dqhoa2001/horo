<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '申し込み後のサンクスメール',
                'class_name' => 'ThanksForAppraisal',
                'title' => '【星の舞】会員登録が完了致しました',
                'content' => '
                    会員登録が完了致しました。
                    このたびは、会員登録をして頂き誠にありがとうございます。

                    ご記入頂いたメールアドレスへ、購入完了メールをお送りしております。
                    しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。
                    ご確認お願いします。

                    ▼星の舞　マイページへのログインはこちら
                    <a href="{{ $login_url }}" target="_blank">{{ $login_url }}</a>
                    　※ログインメールアドレス、パスワードは申し込み時にご記入頂いた内容でログインできます。
                    　※個人鑑定、家族鑑定などはマイページにログイン後にご覧いただけます。
                ',
            ],
            [
                'template_name' => '家族鑑定のご購入ありがとうございました',
                'class_name' => 'ThanksForFamilyAppraisal',
                'title' => '【星の舞】家族鑑定のご購入ありがとうございました',
                'content' => '
                    この度は家族鑑定のご購入ありがとうございました。
                    ご登録頂いたメールアドレスへ、購入完了メールをお送りしております。
                    しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。
                    鑑定結果は下記、マイページ内「家族鑑定」メニューにてご確認ください。
                    <a href="{{ $family_appraisals_show_url }}" target="_blank">{{ $family_appraisals_show_url }}</a>
                ',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder3 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '購入完了メール',
                'class_name' => 'CompletePurchase',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$full_name}}様

                    このたびは、StellarBlueprint（個人鑑定システム）をご購入頂き誠にありがとうございます。

                    お客様の鑑定結果は、星の舞マイページより早速ご覧いただけます。
                    https://mypage.hoshinomai.jp/user/login

                    お申し込み時に設定いただきましたメールアドレスとパスワードにてログインくださいますようお願いいたします。

                    本サービスによる個人鑑定が皆様の今後の人生のお役に立てましたら幸いです。

                    株式会社星の舞

                    銀行振り込みにてお支払いを頂いた場合は、お振込み案内メールをお送りしております。
                    お手数をおかけしますが、ご確認お願いします。
                ',
            ],
            [
                'template_name' => '家族鑑定の購入完了メール',
                'class_name' => 'CompleteForFamilyAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様

                    このたびは、StellarBlueprint（個人鑑定システム）の家族鑑定をご購入頂き誠にありがとうございます。

                    鑑定結果は、星の舞マイページより早速ご覧いただけます。
                    https://mypage.hoshinomai.jp/user/login

                    お申し込み時に設定いただきましたメールアドレスとパスワードにてログインくださいますようお願いいたします。

                    本サービスによる個人鑑定が皆様の今後の人生のお役に立てましたら幸いです。

                    株式会社星の舞

                    銀行振り込みにてお支払いを頂いた場合は、お振込み案内メールをお送りしております。
                    お手数をおかけしますが、ご確認お願いします。
                ',
            ],
            // [
            //     'template_name' => '個人鑑定のご購入ありがとうございました',
            //     'class_name' => 'ThanksForPersonalAppraisal',
            //     'title' => '【星の舞】個人鑑定のご購入ありがとうございました',
            //     'content' => '
            //         個人鑑定のご購入ありがとうございました。

            //         ご登録頂いたメールアドレスへ、購入完了メールをお送りしております。
            //         しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。
            //         ご確認お願いします。

            //         <a href="{{ $personal_appraisals_show_url }}" target="_blank">{{ $personal_appraisals_show_url }}</a>
            //     ',
            // ],
            [
                'template_name' => '個人鑑定の購入完了メール',
                'class_name' => 'CompleteForPersonalAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様
                    このたびは、StellarBlueprint（個人鑑定システム）をご購入頂き誠にありがとうございます。

                    鑑定結果は、星の舞マイページより早速ご覧いただけます。
                    https://mypage.hoshinomai.jp/user/login

                    お申し込み時に設定いただきましたメールアドレスとパスワードにてログインくださいますようお願いいたします。

                    本サービスによる個人鑑定が皆様の今後の人生のお役に立てましたら幸いです。


                    株式会社星の舞
                ',
            ],
            [
                'template_name' => 'この度は個人Solar Return鑑定のご購入ありがとうございました。',
                'class_name' => 'CompleteForPersonalSolarAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様
                    このたびは、太陽回帰自動鑑定システム「Solar Return」をご購入頂き誠にありがとうございます。

                    鑑定結果は、星の舞マイページよりさっそくご覧いただけます。
                    https://mypage.hoshinomai.jp/user/login ※マイページトップではなく、鑑定結果ページに直接とべますか？

                    お申し込み時に設定いただきましたメールアドレスとパスワードにてログインくださいますようお願いいたします。

                    本サービスが{{$name}}様の人生がより良くなる一助となりますと幸いです。


                    株式会社　星の舞
                ',
            ],
            [
                'template_name' => 'この度は家族Solar Return鑑定のご購入ありがとうございました。',
                'class_name' => 'CompleteForFamilySolarAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」の家族鑑定をご購入頂き誠にありがとうございます。

                    鑑定結果は、星の舞マイページより早速ご覧いただけます。
                    https://mypage.hoshinomai.jp/user/login ※マイページトップではなく、鑑定結果ページに直接とべますか？

                    お申し込み時に設定いただきましたメールアドレスとパスワードにてログインくださいますようお願いいたします。

                    本サービスが{{$name}}様の人生がより良くなる一助となりますと幸いです。

                    株式会社　星の舞
                ',
            ],
        ]);
    }
}

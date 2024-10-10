<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder6 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '製本用振込先記述メール（銀行振込の人用）',
                'class_name' => 'BookbindingBankInfoMailForBank',
                'title' => '【星の舞】製本のお申し込みを受け付けました',
                'content' => '
                    {{ $name }}様

                    この度はSTELLAR BLUEPRINT製本版をお求めいただきありがとうございます。
                    お手数ですが、以下の振込先へのお振込みをお願いいたします。

                    お振込みを当社で確認後、製本発送作業開始通知をお送りさせていただきます。
                    なるべく早い対応を心がけておりますが、振込確認は１～２営業日ほどお待たせする可能性がありますので、あらかじめご容赦くださいませ。

                    ＜お支払い金額＞
                    {{ $price }}円

                    ＜振込先＞
                    {{ $bank_name }}
                    {{ $branch_name }}
                    {{ $account_type }}
                    {{ $account_number }}
                    {{ $account_holder }}

                    ※お振り込み時のお名前は、登録会員様ご本人のものと一致させていただくようお願いいたします。一致しない場合は、お振り込みの確認に通常よりお時間をいただく場合がございます。
                    記入がない場合はお振り込みの確認ができかねますので、ご注意ください。

                    ※振込手数料はお客様のご負担となります。
                    ※お振込が確認でき次第、サービスのご提供を開始いたします。ご了承ください。
                ',
            ],
            [
                'template_name' => '製本用振込先記述メール（銀行振込の人用）',
                'class_name' => 'BookbindingBankInfoMailForBankSolar',
                'title' => '【星の舞】製本のお申し込みを受け付けました',
                'content' => '
                    {{ $name }}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」製本版をお求めいただきありがとうございます。
                    お手数ですが、以下の振込先へのご入金をお願いいたします。

                    ご入金を弊社で確認後、製本発送作業開始通知をお送りさせていただきます。
                    なるべく早い対応を心がけておりますが、振込確認は１～２営業日ほどお待たせする可能性がありますので、あらかじめご容赦くださいませ。

                    ＜お支払い金額＞
                    {{ $price }}円

                    ＜振込先＞
                    {{ $bank_name }}
                    {{ $branch_name }}
                    {{ $account_type }}
                    {{ $account_number }}
                    {{ $account_holder }}

                    ※お振り込み時のお名前は、登録会員様ご本人のものと一致させていただくようお願いいたします。一致しない場合は、お振り込みの確認に通常よりお時間をいただく場合がございます。
                    記入がない場合はお振り込みの確認ができかねますので、ご注意ください。

                    ※振込手数料はお客様のご負担となります。
                    ※お振込が確認でき次第、サービスのご提供を開始いたします。ご了承ください。

                    株式会社　星の舞
                ',
            ],
        ]);
    }
}

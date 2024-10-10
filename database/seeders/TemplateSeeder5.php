<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder5 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '製本申し込み受付メール（銀行振込の人用）',
                'class_name' => 'BookbindingUserApplyMailForBank',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{ $full_name }}様
                    この度はStellarBlueprintの製本サービスをお求めいただきありがとうございました。
                    製本のお申込みを以下の通り受け付けましたのでご確認ください。

                    お振込みが確認でき次第、郵送させて頂きます。
                    お振込み先は、別途メールを送付させて頂いております。

                    ＜郵送先について＞
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}

                    お申し込み内容に誤りがある場合は、お手数ですが下記までご連絡ください。
                ',
            ],
            [
                'template_name' => '製本申し込み後、振込確認済みメール（銀行振込の人用）',
                'class_name' => 'BookbindingUserApplyMailForBankComplete',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{ $full_name }}様
                    この度はSTELLAR BLUEPRINTをお求めくださりありがとうございます。
                    銀行振込のお支払いを確認いたしました。

                    以下の、郵送先に製本をお送りいたします。

                    ＜郵送先について＞
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}

                    配送予定日：{{ $scheduled_shipping_date }}

                    ご不明な点がございましたら、お気軽にお問い合わせください。

                    株式会社星の舞
                ',
            ],
            [
                'template_name' => '製本申し込み受付メール（銀行振込の人用）',
                'class_name' => 'BookbindingUserApplySolarMailForBank',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{ $full_name }}様
                    このたびは、太陽回帰自動鑑定システム「Solar Return」の製本サービスをお求めいただきありがとうございました。
                    製本のお申込みを以下の通り受け付けましたのでご確認ください。

                    お振込みが確認でき次第、郵送させて頂きます。
                    お振込み先は、別途メールを送付させて頂いておりますので、別途ご確認をお願いいたします。

                    ＜郵送先について＞
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}

                    お申し込み内容に誤りがある場合は、お手数ですが下記までご連絡ください。

                    株式会社　星の舞
                ',
            ],
            [
                'template_name' => '製本申し込み後、振込確認済みメール（銀行振込の人用）',
                'class_name' => 'BookbindingUserApplySolarMailForBankComplete',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{ $full_name }}様
                    このたびは、太陽回帰自動鑑定システム「Solar Return」をお求めくださりありがとうございます。
                    銀行振込のご入金を確認いたしました。

                    以下の、郵送先に製本をお送りいたします。

                    ＜郵送先について＞
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}

                    配送予定日：{{ $scheduled_shipping_date }}

                    ご不明な点がございましたら、お気軽にお問い合わせください。

                    株式会社　星の舞
                ',
            ],
        ]);
    }
}

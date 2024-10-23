<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder11 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => 'SolarReturnMailForCredit',
                'class_name' => 'BookbindingUserApplyMailForCredit',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{$full_name}}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」をお求めいただきありがとうございます。

                    製本のお申込みを以下の通り受け付けましたのでご確認ください。

                    配送予定日：{{ $scheduled_shipping_date }}

                    お申し込み内容は以下の通りです。
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}


                    発送完了メールはお送りいたしません。
                    万一上記配送予定日を1週間ほど過ぎてもお届けがない場合は、
                    配送トラブル等が考えられますので、
                    info@hoshino-mai.org までお問い合わせください。
                ',
            ],
        ]);
    }
}

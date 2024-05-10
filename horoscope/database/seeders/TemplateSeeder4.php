<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder4 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '製本申し込み受付メール',
                'class_name' => 'BookbindingUserApplyMail',
                'title' => '【星の舞】製本のお申し込みありがとうございました',
                'content' => '
                    {{ $full_name }}様
                    いつもご利用ありがとうございます。星の舞です。

                    製本のお申込みを受け付けました。

                    配送予定日：{{ $scheduled_shipping_date }}

                    お申し込み内容は以下の通りです。
                    ▪️配送先氏名：{{ $purchase_name }}
                    ▪️郵便番号：{{ $post_number }}
                    ▪️住所：{{ $address }}{{ $building }}
                    ▪️電話番号：{{ $tel }}


                    お申し込み内容に誤りがある場合は、お手数ですが下記までご連絡ください。
                ',
            ],
        ]);
    }
}

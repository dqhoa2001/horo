<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder7 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '家族鑑定のご購入ありがとうございました',
                'class_name' => 'ThanksForFamilyBankAppraisal',
                'title' => '【星の舞】家族鑑定のご購入ありがとうございました',
                'content' => '
                    家族鑑定のご購入ありがとうございました。
                    ご登録頂いたメールアドレスへ、購入完了メールをお送りしております。
                    しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。
                    ご確認お願いします。
                ',
            ],
        ]);
    }
}

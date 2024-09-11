<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder10 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '個人鑑定のご購入ありがとうございました',
                'class_name' => 'ThanksForPersonalAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    この度は個人鑑定のご購入ありがとうございました。
                    ご登録頂いたメールアドレスへ、購入完了メールをお送りしております。
                    しばらく経ってもメールが届かない場合は、入力頂いたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。
                    鑑定結果は下記、マイページ内「家族鑑定」メニューにてご確認ください。
                    <a href="{{ $personal_appraisals_show_url }}" target="_blank">{{ $personal_appraisals_show_url }}</a>
                ',
            ],
            [
                'template_name' => '個人Solar Return鑑定のご購入ありがとうございました',
                'class_name' => 'ThanksForPersonalSolarAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」のご購入をいただき、ありがとうございました。
                    ご登録頂いたメールアドレスへ、購入完了メールをお送りいたしました。
                    しばらく経ってもメールが届かない場合は、ご入力いただいたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。

                    鑑定結果は下記、マイページ内「Solar Return」メニューにてご確認ください。
                    <a href="{{ $personal_solar_appraisals_show_url }}" target="_blank">{{ $personal_solar_appraisals_show_url }}</a>

                    株式会社　星の舞
                ',
            ],
            [
                'template_name' => '家族Solar Return鑑定のご購入ありがとうございました',
                'class_name' => 'ThanksForFamilySolarAppraisal',
                'title' => '【星の舞】ご購入ありがとうございました',
                'content' => '
                    {{$name}}様
                
                    このたびは、ご家族の「Solar Return」鑑定のご購入をいただき、ありがとうございました。
                    ご登録頂いたメールアドレスへ、購入完了メールをお送りいたしました。
                    しばらく経ってもメールが届かない場合は、ご入力いただいたメールアドレスが間違っているか、迷惑メールフォルダに振り分けられている可能性がございます。

                    鑑定結果は下記、マイページ内「家族鑑定」メニューにてご確認ください。
                    <a href="{{ $family_solar_appraisals_show_url }}" target="_blank">{{ $family_solar_appraisals_show_url }}</a>

                    株式会社　星の舞
                ',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder9 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates')->insert([
            [
                'template_name' => 'リマインダー 太陽光発電購入メール',
                'class_name' => 'ReminderPurchaseSolar',
                'title' => '【星の舞】Solar Returnのご案内',
                'content' => '
                    {{$full_name}}様

                    いつもお世話になっております。

                    {{$full_name}}様のお誕生日が近づいてまいりました。
                    弊社が提供している未来予測鑑定、Solar Returnは、お誕生日の3ヵ月前から該当し始め、
                    1ヵ月前からははっきりと影響が強くなります。

                    太陽が生まれた時の位置に戻ってからの新たな一年がどうなりそうか、Solar Returnで予測してみませんか。

                    {{$full_name}}様がこの一年をよりクリエイティブに楽しく送るためのお手伝いができましたら幸いです。

                    Solar Returnについて、詳しくはこちらをご覧ください。
                    <a href="https://hoshinomai.jp/solar-return" target=""_blank"">https://hoshinomai.jp/solar-return</a>

                    お申し込みはこちらよりお願いいたします。
                    <a href="https://mypage.hoshinomai.jp/user/solar_appraisals" target=""_blank"">https://mypage.hoshinomai.jp/user/solar_appraisals</a>

                    株式会社　星の舞
                ',
            ],
        ]);
    }
}

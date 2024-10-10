<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => 'お問い合わせ完了メール',
                'class_name' => 'DoneContact',
                'title' => '【星の舞】お問い合わせ完了メール',
                'content' => '
                    {{ $name }}様
                    いつもご利用ありがとうございます。星の舞です。

                    お問い合わせありがとうございます。
                    内容を確認の上、担当者よりご連絡させていただきますので、しばらくお待ちください。

                    ※鑑定結果に対する個別の質問はお受けいたしかねます。
                    ※内容によっては返信できない場合もございますので予めご了承ください。

                    ▪️お問い合わせ種別
                    {{ $inquiry_type_name }}

                    ▪️内容
                    {{ $content }}
                ',
            ],
            [
                'template_name' => 'お問い合わせ受付メール',
                'class_name' => 'ContactReceived',
                'title' => '【星の舞】お問い合わせがありました',
                'content' => '
                    {{ $name }}様よりお問い合わせがありました。

                    ▪️メールアドレス
                    {{ $email }}

                    ▪️お問い合わせ種別
                    {{ $inquiry_type_name }}

                    ▪️内容
                    {{ $content }}
                ',
            ],
            [
                'template_name' => '申し込み受付メール',
                'class_name' => 'AppraisalReceivedForBank',
                'title' => '【星の舞】お申し込みを受け付けました',
                'content' => '
                    {{ $name }}様

                    この度はSTELLAR BLUEPRINTをお求めいただきありがとうございます。
                    お手数ですが、以下の振込先へのお振込みをお願いいたします。

                    お振込みを当社で確認後、鑑定結果の受け取り通知をお送りさせていただきます。
                    なるべく早い対応を心がけておりますが、１～２営業日ほどお待たせする可能性がありますので、あらかじめご容赦くださいませ。

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
                'template_name' => '申し込み受付メール',
                'class_name' => 'SolarAppraisalReceivedForBank',
                'title' => '【星の舞】製本のお申し込み',
                'content' => '
                    {{ $name }}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」の製本版をお求めいただきありがとうございます。
                    お手数ですが、以下の振込先へのご入金をお願いいたします。

                    ご入金を弊社で確認後、製本発送作業開始通知をお送りさせていただきます。
                    なるべく早い対応を心がけておりますが、１～２営業日ほどお待たせする可能性がありますので、あらかじめご容赦くださいませ。

                    ＜お支払い金額＞
                    {{ $price }}円

                    ＜振込先＞
                    {{ $bank_name }}
                    {{ $branch_name }}
                    {{ $account_type }}
                    {{ $account_number }}
                    {{ $account_holder }}

                    ※お振り込み時のお名前は、登録会員様ご本人のものと一致させていただくようお願いいたします。
                    一致しない場合は、お振り込みの確認に通常よりお時間をいただく場合がございます。
                    記入がない場合はお振り込みの確認ができかねますので、ご注意ください。

                    ※振込手数料はお客様のご負担となります。
                    ※お振込が確認でき次第、サービスのご提供を開始いたします。ご了承ください。
                ',
            ],
            [
                // お支払い確認メール
                'template_name' => 'お支払い確認メール',
                'class_name' => 'PayStatusChange',
                'title' => '【星の舞】お支払いを確認いたしました',
                'content' => '
                    {{ $name }}様

                    この度はSTELLAR BLUEPRINTをお求めくださりありがとうございます。
                    銀行振込のお支払いを確認いたしました。

                    以下に、ご購入頂いた鑑定結果のご案内をお送りいたします。

                    <a href="{{ $appraisal_url }}" target="_blank">{{ $appraisal_url }}</a>
                    こちらからログインいただきますと、鑑定結果をご覧いただくことができます。
                    {{ $name }}様の人生がより良くなる一助となりますと幸いです。

                    ご不明な点がございましたら、お気軽にお問い合わせください。

                    株式会社星の舞
                ',
            ],
            [
                // お支払い確認メール
                'template_name' => 'お支払い確認メール',
                'class_name' => 'PayStatusSolarChange',
                'title' => '【星の舞】お支払いを確認いたしました',
                'content' => '
                    {{ $name }}様

                    このたびは、太陽回帰自動鑑定システム「Solar Return」をお求めくださりありがとうございます。
                    銀行振込のお支払いを確認いたしました。

                    以下に、ご購入頂いた鑑定結果のご案内をお送りいたします。

                    <a href="{{ $appraisal_url }}" target="_blank">{{ $appraisal_url }}</a>
                    こちらからログインいただきますと、鑑定結果をご覧いただくことができます。
                    {{ $name }}様の人生がより良くなる一助となりますと幸いです。

                    ご不明な点がございましたら、お気軽にお問い合わせください。

                    株式会社　星の舞
                ',
            ],
            [
                // 新規登録確認メール
                'template_name' => '新規登録確認メール',
                'class_name' => 'CustomVerifyEmail',
                'title' => '【星の舞】メールアドレス確認を完了してください',
                'content' => '
                    この度は星の舞の会員登録をいただき登録ありがとうございます。
                    下記のURLをクリックして会員登録手続きを完了して下さい。
                    <a href="{{ $verification_url }}" target="_blank">{{ $verification_url }}</a>
                ',
            ],
            [
                // 退会完了メール
                'template_name' => '退会完了メール',
                'class_name' => 'Withdraw',
                'title' => '【星の舞】退会の手続きが完了しました',
                'content' => '
                    退会手続きが完了しました。
                    ご利用ありがとうございました。
                    再度ログインしたい場合は管理者へお問い合わせください。
                    <a href="{{ $withdraw_url }}" target="_blank">{{ $withdraw_url }}</a>
                ',
            ],
            [
                // メールフッダー
                'template_name' => 'メールフッダー',
                'class_name' => 'footer',
                'title' => 'フッター',
                'content' => '
                    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
                    このメールは、星の舞のサイトから自動送信しております。
                    万が一、このメールにお心当たりの無い場合は、
                    お手数ですが下記、管理者へお問い合わせまでお知らせください。
                    管理者メールアドレス
                    <a href="mailto:{{ $admin_email }}" target="_blank">{{ $admin_email }}</a>
                    星の舞公式HP
                    <a href="{{ $homepage_url }}" target="_blank">{{ $homepage_url }}</a>
                    ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
                ',
            ],
        ]);

    }
}

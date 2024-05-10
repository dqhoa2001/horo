<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder8 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('templates')->insert([
            [
                'template_name' => '製本の発注にエラーが発生しました。',
                'class_name' => 'ShippingError',
                'title' => '【星の舞】製本の発注にエラーが発生しました',
                'content' => '
                    製本の発注にエラーが発生しました。
                    お手数ですが、管理者・または開発担当までご連絡ください。

                    エラー内容：{{ $firstErrorInfo }}
                ',
            ],
        ]);
    }
}

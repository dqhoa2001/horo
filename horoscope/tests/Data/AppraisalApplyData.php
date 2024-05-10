<?php

namespace Tests\Data;

/**
 * featureテストで必要なフォームデータを定義するクラス
 */
class AppraisalApplyData
{
    public static function data(): array
    {
        return [
            'birthday' => '2000-01-01',
            'birthday_time' => '12:00',
            'birthday_prefectures' => '東京都',
            'birthday_city' => '渋谷区',
        ];
    }
}

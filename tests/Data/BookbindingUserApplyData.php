<?php

namespace Tests\Data;

/**
 * featureテストで必要なフォームデータを定義するクラス
 */
class BookbindingUserApplyData
{
    public static function data(): array
    {
        return [
            'zip' => '1234567',
            'address' => '東京都渋谷区',
            'building' => '渋谷ビル',
            'building_name' => 'みんな太郎',
            'tel' => '09012345678',
        ];
    }
}

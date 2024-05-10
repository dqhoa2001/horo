<?php

namespace Tests\Data;

/**
 * featureテストで必要なフォームデータを定義するクラス
 */
class UserData
{
    public static function data(): array
    {
        return [
            'name1' => '名前姓',
            'name2' => '名前名',
            'kana1' => 'カナセイ',
            'kana2' => 'カナメイ',
            'email' => 'feature@test.com',
            'password' => '13NM224a',
        ];
    }
}

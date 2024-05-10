<?php

namespace Tests\Data;

/**
 * featureテストで必要なフォームデータを定義するクラス
 */
class FamilyData
{
    public static function data(): array
    {
        return [
            'relationship' => '父',
            'family_name1' => '名前姓',
            'family_name2' => '名前名',
        ];
    }
}

<?php

namespace App\Enums;

enum TargetType: int
{
    case USER = 1; // 自分
    case FAMILY = 2; // 家族

    /** 表示用のテキストを取得 */
    public function text(): string
    {
        return match ($this) {
            self::USER => '自分',
            self::FAMILY => '家族',
        };
    }
}

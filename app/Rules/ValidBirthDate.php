<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Validator;
class ValidBirthDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 誕生日が未来の日付でないことを確認
        if (!\Carbon\Carbon::parse($value)->isPast()) {
            $fail("生年月日は未来の日付を選択できません。");
        }
    }

    // 生年月日を3つセレクトボタンで分けている場合のバリデーション
    public static function validateBirthDate(Validator $validator, int $year, int $month, int $day): void
    {
        // 誕生日が未来の日付でないことを確認
        $date = \Carbon\Carbon::createFromDate($year, $month, $day);
        if (!$date->isPast() && !$date->isToday()) {
            $validator->errors()->add('birth_day', '生年月日は未来の日付を選択できません。');
        }
    }
}

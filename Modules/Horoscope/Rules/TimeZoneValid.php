<?php

namespace Modules\Horoscope\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeZoneValid implements ValidationRule
{
    function __construct(public array $requestData)
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $formData = $this->requestData;
        $selectedTimeZone = $formData['timezone'];

        $longitude = $formData['longitude'];

        $ew = $longitude > 0 ? 1 : -1;

        if (($ew == 1 && $selectedTimeZone < 0) || ($ew == -1 && $selectedTimeZone > 2)) {
            $fail("該当するタイムゾーンを選択してください");
        }
    }

}

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
        // Lấy giá trị của trường 'timezone' từ request
        $selectedTimeZone = $formData['timezone'];

        // Lấy giá trị kinh độ từ trường 'longitude'
        $longitude = $formData['longitude'];

        // Tính toán hướng Đông hoặc Tây dựa trên kinh độ
        $ew = $longitude > 0 ? 1 : -1;

        // Kiểm tra xem múi giờ hợp lệ dựa trên kinh độ và giá trị múi giờ
        if (($ew == 1 && $selectedTimeZone < 0) || ($ew == -1 && $selectedTimeZone > 2)) {
            $fail("該当するタイムゾーンを選択してください");
        }
    }

}

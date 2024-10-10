<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DayOfMonthValid implements ValidationRule
{
    function __construct(public array $requestData)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($attribute);
        $formData = $this->requestData;
        $year = !empty($formData['year']) && $formData['year'] > 1900 && $formData['year'] < 2100;
        $month = !empty($formData['month']) && $formData['month'] > 0 && $formData['month'] < 13;
        $dateValid = false;
        if ($year && $month) {
            $dateValid = checkdate($formData['month'], $formData['day'], $formData['year']);
        }
        
        if (!$dateValid) {
            $fail('The :attribute is invalid.');
        }
    }
}

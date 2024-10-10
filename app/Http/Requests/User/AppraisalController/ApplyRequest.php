<?php

namespace App\Http\Requests\User\AppraisalController;

use App\Enums\TargetType;
use App\Models\AppraisalApply;
use Illuminate\Validation\Rule;
use Modules\Horoscope\Rules\TimeZoneValid;
use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'target_type' => ['required'],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'birthday' => ['date'],
            'birthday_time' => ['date_format:H:i'], // 24時間形式の時間を想定
            'birth_place1' => ['string', 'max:255'],
            'longitude' => ['required', 'numeric', 'between:-179.99,179.99'],
            'latitude' => ['required', 'numeric', 'between:-65.99,65.99'],
            'timezone' => ['required', new TimeZoneValid($this->all())],
            'is_bookbinding' => ['required', 'boolean'],
            'zip' => ['regex:/\A\d{7}\z/', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 3桁-4桁の郵便番号形式を想定
            'address' => ['string', 'max:255', 'exclude_special_chars', 'is_japan_address', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'building_name' => ['string', 'max:255', 'exclude_special_chars', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'tel' => ['custom_phone', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 日本の電話番号形式を想定
            'payment_type' => ['required'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
            // 'stripeToken' => ['required', 'string'],
        ];
    }
}

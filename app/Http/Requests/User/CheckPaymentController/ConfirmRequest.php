<?php

namespace App\Http\Requests\User\CheckPaymentController;

use App\Enums\TargetType;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Rules\ValidBirthDate;
use Illuminate\Validation\Rule;
use Modules\Horoscope\Rules\TimeZoneValid;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'target_type' => ['required'],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'is_bookbinding' => ['required', 'boolean'],
            'bookbinding_name1' => ['string', 'max:255', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 製本の名前
            'bookbinding_name2' => ['string', 'max:255', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 製本の名前
            'is_design' => ['nullable', 'integer', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'zip' => ['regex:/\A\d{7}\z/', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 3桁-4桁の郵便番号形式を想定
            'address' => ['string', 'max:255', 'exclude_special_chars', 'is_japan_address', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'building_name' => ['string', 'max:255', 'exclude_special_chars', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'tel' => ['custom_phone', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 日本の電話番号形式を想定
            'payment_type' => ['required'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
            'total_amount' => ['required', 'integer'],
            'discount_price' => ['required', 'integer'],
            'consent' => ['required'],
            'terms_of_service' => ['required'],
            'personal_information' => ['required'],
            'stripeToken' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
            'cardBrand' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
            'last4' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {

        return $this->only([
            'target_type',
            'relationship',
            'family_name1',
            'family_name2',
            'bookbinding_name1',
            'bookbinding_name2',
            'is_bookbinding',
            'is_design',
            'zip',
            'address',
            'building',
            'building_name',
            'tel',
            'payment_type',
            'coupon_code',
            'total_amount',
            'discount_price',
            'consent',
            'terms_of_service',
            'personal_information',
            'stripeToken',
            'cardBrand',
            'last4',
        ]);
    }
}

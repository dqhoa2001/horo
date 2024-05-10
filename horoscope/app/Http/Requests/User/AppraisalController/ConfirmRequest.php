<?php

namespace App\Http\Requests\User\AppraisalController;

use App\Enums\TargetType;
use App\Library\GetPrefNum;
use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use Illuminate\Validation\Rule;
use Modules\Horoscope\Rules\TimeZoneValid;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidBirthDate;
use Illuminate\Validation\Validator;

class ConfirmRequest extends FormRequest
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
            'target_type' => ['required'],
            'family_id'   => [
                Rule::requiredIf($this->input('target_type') === TargetType::FAMILY),
                'not_in:選択してください',
            ],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            // 'birthday' => ['required', 'date'],
            'birth_year' => ['required', 'integer', 'between:1900,2100'],
            'birth_month' => ['required', 'integer', 'between:1,12'],
            'birth_day' => ['required', 'integer', 'between:1,31'],
            'birthday_time' => ['date_format:H:i'], // 24時間形式の時間を想定
            'birthday_prefectures' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'numeric', 'between:-179.99,179.99'],
            'latitude' => ['required', 'numeric', 'between:-65.99,65.99'],
            'timezone' => ['required', new TimeZoneValid($this->all())],
            'is_bookbinding' => ['required', 'boolean'],
            'coupon_type' => ['required', 'integer'],
            'discount_price' => ['required', 'integer'],
            'total_amount' => ['required', 'integer'],
            'bookbinding_name1' => ['string', 'max:255', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 製本の名前
            'bookbinding_name2' => ['string', 'max:255', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 製本の名前
            'zip' => ['regex:/\A\d{7}\z/', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 3桁-4桁の郵便番号形式を想定
            'address' => ['string', 'max:255', 'exclude_special_chars', 'is_japan_address', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'building_name' => ['string', 'max:255', 'exclude_special_chars', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'tel' => ['custom_phone', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)], // 日本の電話番号形式を想定
            'is_design' => ['nullable', 'integer', Rule::requiredIf($this->input('is_bookbinding') === AppraisalApply::BOOK_ENABLED)],
            'payment_type' => ['required'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
            'consent' => ['required'],
            'terms_of_service' => ['required'],
            'personal_information' => ['required'],
            'stripeToken' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
            'cardBrand' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
            'last4' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string'],
        ];
    }

    // 生年月日の未来日のチェック
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            ValidBirthDate::validateBirthDate($validator, $this->birth_year, $this->birth_month, $this->birth_day);
        });
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        // // year month dayを結合してbirthdayにする
        $birthday = $this->input('birth_year') . '-' . $this->input('birth_month') . '-' . $this->input('birth_day');
        // カーボンオブジェクトに変換
        $birthday = \Carbon\Carbon::parse($birthday);
        $this->merge(['birthday' => $birthday]);

        return $this->only([
            'target_type',
            'family_id',
            'relationship',
            'name1',
            'name2',
            'birthday',
            'birth_year',
            'birth_month',
            'birth_day',
            'birthday_time',
            'bookbinding_name1',
            'bookbinding_name2',
            'birthday_prefectures',
            'longitude',
            'latitude',
            'timezone',
            'is_bookbinding',
            'coupon_type',
            'discount_price',
            'total_amount',
            'zip',
            'address',
            'building',
            'building_name',
            'tel',
            'is_design',
            'payment_type',
            'coupon_code',
            'consent',
            'terms_of_service',
            'personal_information',
            'stripeToken',
            'cardBrand',
            'last4',
        ]);
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'birthday_prefectures' => '生まれた場所（都道府県市区町村）',
        ];
    }
}

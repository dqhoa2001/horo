<?php

namespace App\Http\Requests\User\SolarAppraisalController;

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
            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'family_id' => ['required', 'string', 'max:255'],
            'target_type' => ['required'],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            // 'birthday' => ['date', new ValidBirthDate()],
            'birth_year' => ['required', 'integer', 'between:1900,2100'],
            'birth_month' => ['required', 'integer', 'between:1,12'],
            'birth_day' => ['required', 'integer', 'between:1,31'],
            'birthday_time' => ['date_format:H:i'], // 24時間形式の時間を想定
            // 'birth_place1' => ['string', 'max:255'],
            'birthday_prefectures' => ['required', 'string', 'max:255'],
            'longitude' => ['required', 'numeric', 'between:-179.99,179.99'],
            'latitude' => ['required', 'numeric', 'between:-65.99,65.99'],
            'timezone' => ['required', new TimeZoneValid($this->all())],
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

    // 生年月日の未来日のチェック
    public function withValidator(Validator $validator): void
    {
        // $validator->after(function ($validator) {
        //     ValidBirthDate::validateBirthDate($validator, $this->birth_year, $this->birth_month, $this->birth_day);
        // });
        $validator->after(function ($validator) {
            $birth_year = $this->input('birth_year');
            $birth_month = $this->input('birth_month');
            $birth_day = $this->input('birth_day');

            // Kiểm tra các giá trị không null trước khi gọi validateBirthDate
            if (isset($birth_year) && isset($birth_month) && isset($birth_day)) {
                ValidBirthDate::validateBirthDate($validator, (int) $birth_year, (int) $birth_month, (int) $birth_day);
            }
        });
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        // year month dayを結合してbirthdayにする
        $birthday = $this->input('birth_year') . '-' . $this->input('birth_month') . '-' . $this->input('birth_day');
        // カーボンオブジェクトに変換
        $birthday = \Carbon\Carbon::parse($birthday);
        $this->merge(['birthday' => $birthday]);

        return $this->only([
            'name1',
            'name2',
            'family_id',
            'target_type',
            'relationship',
            'family_name1',
            'family_name2',
            'bookbinding_name1',
            'bookbinding_name2',
            'birth_year',
            'birth_month',
            'birth_day',
            'birthday',
            'birthday_time',
            'birthday_prefectures',
            'longitude',
            'latitude',
            'timezone',
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

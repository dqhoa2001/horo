<?php

namespace App\Http\Requests\User\SolarAppraisalController;

use App\Enums\TargetType;
use App\Models\AppraisalApply;
use App\Models\SolarApply;
use App\Rules\ValidBirthDate;
use Illuminate\Validation\Rule;
use Modules\Horoscope\Rules\TimeZoneValid;
use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'family_id' => [
                Rule::requiredIf($this->input('target_type') === TargetType::FAMILY),
                'string',
                'max:255',
                'not_in:選択してください',
            ],
            'name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'target_type' => ['required'],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'birthday' => ['date'],
            'solar_return' =>['nullable'],
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

    protected function mergeDataIntoRequest(): void
    {
        $mergedData = [
            'email' => $this['email1'] . '@' . $this['email2'],
        ];
        $this->merge($mergedData);
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->all();
    }

    //リダイレクト先を変更
    protected function getRedirectUrl()
    {
        return route('user.solar_appraisals.create');
    }
}

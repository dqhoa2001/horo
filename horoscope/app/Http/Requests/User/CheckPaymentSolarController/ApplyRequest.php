<?php

namespace App\Http\Requests\User\CheckPaymentSolarController;

use App\Enums\TargetType;
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
    public function rules()
    {
        return [
            'family_id'   => [
                Rule::requiredIf($this->input('target_type') === TargetType::FAMILY),
                'not_in:選択してください',
            ],
            'name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'birthday' => ['date', new ValidBirthDate()],
            'target_type' => ['required'],
            'relationship' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name1' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'family_name2' => ['string', 'max:255', Rule::requiredIf($this->input('target_type') === TargetType::FAMILY)],
            'is_bookbinding' => ['required', 'boolean'],
            'zip' => ['regex:/\A\d{7}\z/', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)], // 3桁-4桁の郵便番号形式を想定
            'bookbinding_name' => ['string', 'max:255', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)], // Tên của việc ràng buộc
            'address' => ['string', 'max:255', 'exclude_special_chars', 'is_japan_address', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'building_name' => ['string', 'max:255', 'exclude_special_chars', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)],
            'tel' => ['custom_phone', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)], // Giả định định dạng số điện thoại Nhật Bản
            'is_design' => ['nullable', 'integer', Rule::requiredIf($this->input('is_bookbinding') === SolarApply::BOOK_ENABLED)],
            'payment_type' => ['required'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
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
        return route('user.check_payment_solar.create');
    }
}

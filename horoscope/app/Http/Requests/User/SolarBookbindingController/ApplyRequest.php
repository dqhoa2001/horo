<?php

namespace App\Http\Requests\User\SolarBookbindingController;

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
            'solar_appraisal_apply_ids' => ['required', 'array'],
            'solar_appraisal_apply_ids.*' => ['required', 'integer'],
            'pdf_types' => ['required', 'array'],
            'bookbinding_names1' => ['required', 'array'],
            'bookbinding_names1.*' => ['nullable', 'string', 'max:255'],
            'bookbinding_names2' => ['required', 'array'],
            'bookbinding_names2.*' => ['nullable', 'string', 'max:255'],
            'zip' => ['regex:/\A\d{7}\z/'],
            'address' => ['required', 'string', 'max:255', 'exclude_special_chars'],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'building_name' => ['string', 'max:255', 'exclude_special_chars'],
            'tel' => ['custom_phone'],
            'payment_type' => ['required'],
            'coupon_type' => ['nullable'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->all();
    }
}

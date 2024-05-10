<?php

namespace App\Http\Requests\Admin\RegisterCouponController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'coupon_price' => ['required', 'integer', 'min:0'],
            'back_point' => ['required', 'integer', 'min:0'],
            'time_limit' => ['required', 'integer', 'min:0'],
            'use_limit' => ['required', 'integer', 'min:0', 'max:99'],
            'is_personal_appr_enabled' => ['required', 'boolean'],
            'is_family_appr_enabled' => ['required', 'boolean'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'coupon_price',
            'back_point',
            'time_limit',
            'use_limit',
            'is_personal_appr_enabled',
            'is_family_appr_enabled',
        ]);
    }
}

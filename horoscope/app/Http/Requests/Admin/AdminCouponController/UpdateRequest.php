<?php

namespace App\Http\Requests\Admin\AdminCouponController;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
        // TODO
        return [
            'user_id' => ['required', 'select_check'],
            'coupon_name' => ['required', 'string', 'max:255'],
            'coupon_code' => ['required', 'string', 'max:255'],
            'coupon_price' => ['required', 'integer', 'min:0'],
            'back_point' => ['required', 'integer', 'min:0'],
            'is_personal_appr_enabled' => ['required', 'boolean'],
            'is_family_appr_enabled' => ['required', 'boolean'],
            'is_infinite' => ['nullable'],
            'time_limit_day' => ['nullable', 'required_without:is_infinite', 'date'],
            'use_limit' => ['required', 'integer', 'min:0', 'max:99'],
            'is_personal_solar_return_appr_enabled' => ['required', 'boolean'],
            'is_family_solar_return_appr_enabled' => ['required', 'boolean'],
        ];
    }
    /**
     * @return array
     */
    public function substitutable()
    {
        $data = $this->only([
            'user_id',
            'coupon_name',
            'coupon_code',
            'coupon_price',
            'back_point',
            'is_personal_appr_enabled',
            'is_family_appr_enabled',
            'time_limit_day',
            'use_limit',
            'is_personal_solar_return_appr_enabled',
            'is_family_solar_return_appr_enabled',
        ]);

        if (!empty($this->is_infinite)) {
            // 無期限の場合は2099-12-31を入れる
            $data['time_limit_day'] = Carbon::create(2099, 12, 31);
        }

        return $data;
    }
}

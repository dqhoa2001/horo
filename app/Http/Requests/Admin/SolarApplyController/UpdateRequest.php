<?php

namespace App\Http\Requests\Admin\SolarApplyController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            // 'latitude' => ['required', 'numeric'],
            // 'longitude' => ['required', 'numeric'],
            // 'timezome' => ['required', 'integer'],
            'solar_date' => ['required', 'integer', 'min:1900']
        ];
    }

    public function substitutable(): array
    {
        return $this->only([
            // 'birthday',
            // 'birthday_time',
            // 'birthday_prefectures',
            // 'latitude',
            // 'longitude',
            // 'timezome',
            'solar_date'
        ]);
    }
}

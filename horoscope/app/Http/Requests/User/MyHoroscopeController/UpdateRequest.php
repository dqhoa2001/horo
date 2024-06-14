<?php

namespace App\Http\Requests\User\MyHoroscopeController;

use App\Rules\ValidBirthDate;
use Illuminate\Validation\Validator;
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
            // 'birthday'                => ['required', 'date_format:Y-m-d'],
            'birth_year'           => ['required', 'integer', 'between:1900,2100'],
            'birth_month'          => ['required', 'integer', 'between:1,12'],
            'birth_day'            => ['required', 'integer', 'between:1,31'],
            'time'                 => ['required', 'date_format:H:i'],
            'birthday_prefectures' => ['required', 'string', 'max:255'],
            'longitude'            => ['required', 'numeric', 'between:-179.99,179.99'],
            'latitude'             => ['required', 'numeric', 'between:-65.99,65.99'],
            'timezone'             => ['required', 'integer', 'between:-12,12'],
        ];
    }

    // 生年月日の未来日のチェック
    public function withValidator(Validator $validator): void
    {
        // $validator->after(function ($validator) {
        //     ValidBirthDate::validateBirthDate($validator, $this->birth_year, $this->birth_month, $this->birth_day);
        // });
        $validator->after(function ($validator) {
            $validator->after(function ($validator) {
                $birth_year = $this->input('birth_year');
                $birth_month = $this->input('birth_month');
                $birth_day = $this->input('birth_day');

                if (isset($birth_year) && isset($birth_month) && isset($birth_day)) {
                    ValidBirthDate::validateBirthDate($validator, (int) $birth_year, (int) $birth_month, (int) $birth_day);
                }
            });
        });
    }

    public function substitutable(): array
    {
        $birthday = $this->input('birth_year') . '/' . $this->input('birth_month') . '/' . $this->input('birth_day');
        $this->merge(['birthday' => $birthday]);

        return $this->only([
            'birthday',
            'time',
            'birthday_prefectures',
            'longitude',
            'latitude',
            'timezone',
        ]);
    }
}

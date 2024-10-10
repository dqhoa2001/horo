<?php

namespace App\Http\Requests\User\TopController;

use Illuminate\Http\Request;
use App\Rules\ValidBirthDate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PredictRequest extends FormRequest
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
            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            // 'birthday' => ['required', 'date', new ValidBirthDate()],
            'birth_year' => ['required', 'integer', 'between:1900,2100'],
            'birth_month' => ['required', 'integer', 'between:1,12'],
            'birth_day' => ['required', 'integer', 'between:1,31'],
            'birthday_time' => ['required', 'date_format:H:i'],
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
            'birthday_prefectures' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'max:255', 'not_in:Select Time Zone'],
            'background' => ['required', 'string', 'max:255'],
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

            if (isset($birth_year) && isset($birth_month) && isset($birth_day)) {
                ValidBirthDate::validateBirthDate($validator, (int) $birth_year, (int) $birth_month, (int) $birth_day);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function substitutable()
    {
        $birthday = $this->input('birth_year') . '/' . $this->input('birth_month') . '/' . $this->input('birth_day');
        $this->merge([
            'name' => $this->name1 . $this->name2,
            'birthday' => $birthday,
        ]);

        return $this->only([
            'name1',
            'name2',
            'name',
            'birthday',
            'birthday_time',
            'longitude',
            'latitude',
            'birthday_prefectures',
            'timezone',
            'background',
        ]);
    }
}

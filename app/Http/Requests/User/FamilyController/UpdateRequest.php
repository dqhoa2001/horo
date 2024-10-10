<?php

namespace App\Http\Requests\User\FamilyController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Rules\ValidBirthDate;

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
            'name1'                => ['required', 'string', 'max:10'],
            'name2'                => ['required', 'string', 'max:10'],
            'relationship'         => ['required', 'string', 'max:255'],
            // 'birthday'                => ['required', 'date_format:Y-m-d'],
            'birth_year'           => ['required', 'integer', 'between:1900,2100'],
            'birth_month'          => ['required', 'integer', 'between:1,12'],
            'birth_day'            => ['required', 'integer', 'between:1,31'],
            'time'                 => ['required', 'date_format:H:i'],
            'birthday_prefectures' => ['required', 'string', 'max:255'],
            'longitude'            => ['required', 'numeric', 'between:-179.99,179.99'],
            'latitude'             => ['required', 'numeric', 'between:-65.99,65.99'],
            'timezone'             => ['required', 'string', 'max:255'],
        ];
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
            // 'birthday_city'        => '生まれた場所（市区町村）',
        ];
    }

    // 生年月日の未来日のチェック
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            ValidBirthDate::validateBirthDate($validator, $this->birth_year, $this->birth_month, $this->birth_day);
        });
    }

    public function substitutable(): array
    {
        $birthday = $this->input('birth_year') . '/' . $this->input('birth_month') . '/' . $this->input('birth_day');
        $this->merge(['birthday' => $birthday]);

        return $this->only([
            'name1',
            'name2',
            'relationship',
            'birthday',
            'time',
            'birthday_prefectures',
            'longitude',
            'latitude',
            'timezone',
        ]);
    }
}

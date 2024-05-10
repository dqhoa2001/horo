<?php

namespace App\Http\Requests\User\MyHoroscopeController;

use App\Rules\ValidBirthDate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            // 'birthday'                => ['required', 'date_format:Y-m-d', new ValidBirthDate()],
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

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'birthday_prefectures' => '生まれた場所（都道府県）',
            'birthday_city'        => '生まれた場所（市区町村）',
        ];
    }
}

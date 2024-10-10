<?php

namespace App\Http\Requests\Admin\AppraisalApplyController;

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
            'birthday' => ['required', 'date'],
            'birthday_time' => ['required', 'date_format:H:i'],
            'birthday_prefectures' => ['required', 'string'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'timezome' => ['required', 'integer'],
        ];
    }

    public function substitutable(): array
    {
        return $this->only([
            'birthday',
            'birthday_time',
            'birthday_prefectures',
            'latitude',
            'longitude',
            'timezome',
        ]);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZodiacPatternRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'zodiac_id' => 'required',
            'planet_id' => 'required',
            'content' => 'required',
            'content_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'zodiac_id.required' => __('message.required', ['attribute' => __('form.zodiac_name')]),
            'planet_id.required' => __('message.required', ['attribute' => __('form.planet_name')]),
            'content_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
        ];
    }
}

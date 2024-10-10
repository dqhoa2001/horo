<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AspectPatternRequest extends FormRequest
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
            'aspect_id' => 'required',
            'from_planet_id' => 'required',
            'to_planet_id' => 'required',
            'content' => 'required',
            'content_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'aspect_id.required' => __('message.required', ['attribute' => __('form.aspect_name')]),
            'from_planet_id.required' => __('message.required', ['attribute' => __('form.from_planet_name')]),
            'to_planet_id.required' => __('message.required', ['attribute' => __('form.to_planet_name')]),
            'content_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
        ];
    }
}

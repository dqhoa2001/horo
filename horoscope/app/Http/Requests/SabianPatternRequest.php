<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SabianPatternRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'zodiac_id' => 'required',
            'sabian_degrees' => 'required|between:0,29',
            'title' => 'required',
            'title_en' => 'required',
            'content' => 'required',
            'content_en' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'zodiac_id.required' => __('message.required', ['attribute' => __('form.zodiac_name')]),
            'content_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'title.required' => __('message.required', ['attribute' => __('form.title')]),
            'title_en.required' => __('message.required', ['attribute' => __('form.title_en')]),
            'sabian_degrees.required' => __('message.required', ['attribute' => __('form.sabian_degrees')]),
        ];
    }
}
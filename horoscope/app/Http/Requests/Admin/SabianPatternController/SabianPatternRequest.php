<?php

namespace App\Http\Requests\Admin\SabianPatternController;

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
            'title_en' => 'nullable',
            'content' => 'required|max_mb:465',
            'content_en' => 'nullable',
            'content_solar' => 'required|max_mb:465',
            'content_solar_en' => 'nullable',
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
            'content.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 465]),
            'content_solar.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'content_solar.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 465]),
        ];
    }
}

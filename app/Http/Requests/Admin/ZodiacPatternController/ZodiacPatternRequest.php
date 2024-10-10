<?php

namespace App\Http\Requests\Admin\ZodiacPatternController;

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
            'content' => 'required|max_mb:575',
            'content_en' => 'nullable|max:370',
            'content_solar' => 'required|max_mb:575',
            'content_solar_en' => 'nullable|max:370',
        ];
    }

    public function messages(): array
    {
        return [
            'zodiac_id.required' => __('message.required', ['attribute' => __('form.zodiac_name')]),
            'planet_id.required' => __('message.required', ['attribute' => __('form.planet_name')]),
            'content_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'content_en.max' => __('message.max', ['attribute' => __('form.content_english'), 'max' => 370]),
            'content.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 575]),
            'content_solar_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content_solar.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'content_solar_en.max' => __('message.max', ['attribute' => __('form.content_english'), 'max' => 370]),
            'content_en.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 575]),
        ];
    }
}

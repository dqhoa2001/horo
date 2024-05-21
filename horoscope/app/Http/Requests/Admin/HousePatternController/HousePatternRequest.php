<?php

namespace App\Http\Requests\Admin\HousePatternController;

use Illuminate\Foundation\Http\FormRequest;

class HousePatternRequest extends FormRequest
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
            'house_id' => 'required',
            'planet_id' => 'required',
            'content' => 'required|max_mb:410',
            'content_en' => 'nullable',
            'content_solar' => 'required|max_mb:410',
            'content_solar_en' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'house_id.required' => __('message.required', ['attribute' => __('form.house_name')]),
            'planet_id.required' => __('message.required', ['attribute' => __('form.planet_name')]),
            'content_en.required' => __('message.required', ['attribute' => __('form.content_english')]),
            'content.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'content.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 410]),
            'content_solar.required' => __('message.required', ['attribute' => __('form.content_japanese')]),
            'content_solar.max_mb' => __('message.max_mb', ['attribute' => __('form.content_japanese'), 'max' => 410]),
        ];
    }
}

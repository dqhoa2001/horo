<?php

namespace App\Http\Requests\User\ContactController;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmRequest extends FormRequest
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
            'inquiry_type_id' => ['required', 'exists:inquiry_types,id'],
            'content'         => ['required', 'string', 'max:3000'],
            'terms_of_service'         => ['required'],
            'personal_information'         => ['required'],
        ];
    }

    public function substitutable(): array
    {
        return $this->only([
            'inquiry_type_id',
            'content',
        ]);
    }
}

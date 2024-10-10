<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'sometimes|required|email|unique:users,email,' . $this->id,
            'phone' => 'required|numeric',
            'day_of_birth' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            // 'name.required' => __('message.required',['atribute']),
            //name
            'name.required' => __('message.required', ['attribute' => __('form.name')]),
            //email
            'email.required' => __('message.required', ['attribute' => __('form.email')]),
            'email.email' => __('message.email', ['attribute' => __('form.email')]),
            'email.unique' => __('message.unique', ['attribute' => __('form.email')]),
            //phone
            'phone.required' => __('message.required', ['attribute' => __('form.phone')]),
            'phone.numeric' => __('message.numeric', ['attribute' => __('form.phone')]),
            //day_of_birth
            'day_of_birth.required' => __('message.required', ['attribute' => __('form.day_of_birth')]),
            'day_of_birth.date' => __('message.date', ['attribute' => __('form.day_of_birth')]),
        ];
    }
}

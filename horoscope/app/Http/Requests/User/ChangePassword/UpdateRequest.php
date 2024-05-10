<?php

namespace App\Http\Requests\User\ChangePassword;

use App\Rules\MatchPasswordRule;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'now_password' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/',
                'current_password',
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:12', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/',
                'confirmed',
            ],
            'new_password_confirmation' => [
                'required',
                'string',
                'min:8',
                'max:12', 
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,12}$/',
            ],
        ];
    }
}

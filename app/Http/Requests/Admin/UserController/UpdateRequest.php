<?php

namespace App\Http\Requests\Admin\UserController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'member_type' => ['required'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users','email')->where(static function ($query) {
                    $query->whereNull('deleted_at');
                })->ignore($this->route('user'))
            ],
            'point_sum' => ['required', 'integer', 'min:0', 'max:2147483647'],
            'memo' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'member_type',
            'email',
            'point_sum',
            'memo',
        ]);
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'point_sum' => 'ポイント残高',
        ];
    }
}

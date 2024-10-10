<?php

namespace App\Http\Requests\User\UserController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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
            'name1' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'kana1' => ['required', 'string', 'max:255'],
            'kana2' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                // ソフトデリートされたレコードは除外する
                Rule::unique('users','email')->where(static function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'email_confirmation' => ['required', 'string', 'email', 'max:255', 'same:email'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'name1',
            'name2',
            'kana1',
            'kana2',
            'email',
        ]);
    }
}

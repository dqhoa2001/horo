<?php

namespace App\Http\Requests\User\ContactController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'inquiry_type_id' => ['required', 'integer', 'exists:inquiry_types,id'],
            'content'         => ['required', 'string', 'max:3000'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        $this->merge([
            'user_id' => auth()->guard('user')->id(),
        ]);
        return $this->only([
            'user_id',
            'inquiry_type_id',
            'content',
        ]);
    }
}

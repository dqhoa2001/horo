<?php

namespace App\Http\Requests\Admin\UserController;

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
        // TODO
        return [
            'title' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'title',
        ]);
    }
}

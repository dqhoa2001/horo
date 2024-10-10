<?php

namespace App\Http\Requests\Admin\AdminMailController;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['required', 'email', Rule::unique('admin_mails')->ignore($this->admin_mail)],
        ];
    }

    /**
     * @return array
     */
    public function substitutable()
    {
        return $this->only([
            'email',
        ]);
    }
}

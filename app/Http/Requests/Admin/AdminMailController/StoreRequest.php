<?php

namespace App\Http\Requests\Admin\AdminMailController;

use App\Models\AdminMail;
use Illuminate\Validation\Validator;
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
            'email' => ['required', 'email', 'unique:admin_mails,email'],
        ];
    }

    // 最大で10件まで登録できるようにする
    public function withValidator(Validator $validator): void
    {
        $validator->after(static function ($validator) {
            // AdminMailの現在のカウントを確認
            if (AdminMail::count() >= 10) {
                // 10以上の場合、エラーを追加
                $validator->errors()->add('email', '最大で10件までしか登録できません。');
            }
        });
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

<?php

namespace App\Http\Requests\User\SolarBookbindingController;

use App\Models\AppraisalApply;
use App\Models\AppraisalClaim;
use App\Models\SolarApply;
use Illuminate\Validation\Validator;
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
            'solar_appraisal_apply_ids' => ['required', 'array'],
            'solar_appraisal_apply_ids.*' => ['required', 'integer'],
            'zip' => ['regex:/\A\d{7}\z/'],
            'address' => ['string', 'max:255', 'exclude_special_chars', 'is_japan_address'],
            'building' => ['nullable', 'string', 'max:255', 'exclude_special_chars'],
            'bookbinding_names1' => ['required', 'array'],
            'bookbinding_names1.*' => ['nullable', 'string', 'max:255'],
            'bookbinding_names2' => ['required', 'array'],
            'bookbinding_names2.*' => ['nullable', 'string', 'max:255'],
            'building_name' => ['required', 'string', 'max:255', 'exclude_special_chars'],
            'tel' => ['custom_phone'],
            'payment_type' => ['required'],
            'coupon_type' => ['nullable'],
            'coupon_code' => ['nullable', 'string', 'max:255'],
            'consent' => ['required'],
            'stripeToken' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string', ],
            'cardBrand' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string', ],
            'last4' => ['required_if:payment_type,' . AppraisalClaim::CREDIT, 'string', ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $data = $this->all();
        if (empty($data['solar_appraisal_apply_ids'])) {
            $validator->errors()->add('solar_appraisal_apply_ids', '鑑定を選択してください');

            return;
        }

        $data['select_appraisal_applies'] = SolarApply::whereIn('id', $data['solar_appraisal_apply_ids'])->get();

        // リクエストの中の、pdfに関するデータをまとめる
        $data['pdf_types'] = [];
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            // $dataの中の「pdf_type-*」の*の値が$appraisalApplyのidと一致するものを取得
            foreach ($data as $key => $value) {
                if (strpos($key, 'pdf_type-') !== false) {
                    $id = str_replace('pdf_type-', '', $key);
                    if ((int) $id === $appraisalApply->id) {
                        $data['pdf_types'][$appraisalApply->id] = $value;
                    }
                }
            }
        }

        // バリデーション
        $pdfResult = true;
        $bookbindingNames1Result = true;
        $bookbindingNames2Result = true;
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            if (empty($data['pdf_types'][$appraisalApply->id])) {
                $pdfResult = false;
            }
            if ($data['bookbinding_names1'][$appraisalApply->id] === null) {
                $bookbindingNames1Result = false;
            }
            if ($data['bookbinding_names2'][$appraisalApply->id] === null) {
                $bookbindingNames2Result = false;
            }
        }

        $validator->after(static function ($validator) use ($pdfResult, $bookbindingNames1Result, $bookbindingNames2Result) {
            if ($pdfResult === false) {
                $validator->errors()->add('pdf_types', '表紙デザインを選択してください');
            }
            if ($bookbindingNames1Result === false || $bookbindingNames2Result === false) {
                $validator->errors()->add('bookbinding_names', '表紙に表示したい名前を入力してください');
            }
        });
    }

    public function substitutable(): array
    {
        return $this->all();
    }
}

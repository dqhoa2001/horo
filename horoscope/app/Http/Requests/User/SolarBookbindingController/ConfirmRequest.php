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
            'solar_appraisal_apply_ids' => ['nullable', 'array'],
            'solar_appraisal_apply_ids.*' => ['nullable', 'integer'],
            'family_solar_appraisal_apply_ids' => ['nullable', 'array'],
            'family_solar_appraisal_apply_ids.*' => ['nullable', 'integer'],
            'person_ids' => ['required', 'array'],
            'person_ids.*' => ['required', 'integer'],
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
        //vaidate checkbox choose person
        $data['select_person'] = AppraisalApply::whereIn('reference_id', $data['person_ids'])->get();
        if (empty($data['person_ids'])) {
            $validator->errors()->add('person_ids', 'レビューブックを印刷したい人を選択してください');
            return;
        }
        $selectedAppraisalId = [];
        if(isset($data['solar_appraisal_apply_ids'])){
            $selectedAppraisalId = $data['solar_appraisal_apply_ids'];
        }
        if(isset($data['family_solar_appraisal_apply_ids'])){
            $selectedAppraisalId = array_merge($selectedAppraisalId, $data['family_solar_appraisal_apply_ids']);
        }
        $data['select_appraisal_applies'] = AppraisalApply::whereIn('id',$selectedAppraisalId)->get();
        $data['pdf_types'] = [];
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            foreach ($data as $key => $value) {
                    if (strpos($key, 'pdf_type-') !== false) {
                        $id = str_replace('pdf_type-', '', $key);
                        if ((int) $id === $appraisalApply->reference->id ) {
                            $data['pdf_types'][$appraisalApply->id] = $value;
                        }
                    }
            }
        }
        // バリデーション
        $pdfResult = true;
        $bookbindingNames1Result = true;
        $bookbindingNames2Result = true;
        $chooseAppraisalResult = true;

        foreach(  $data['select_appraisal_applies']  as $appraisalApply){
            if (($data['pdf_types'][$appraisalApply->id]) === null) {
                        $pdfResult = false;
            }
            if ($data['bookbinding_names1'][$appraisalApply->reference->id] === null) {
                $bookbindingNames1Result = false;
            }
            if ($data['bookbinding_names2'][$appraisalApply->reference->id] === null) {
                $bookbindingNames2Result = false;
            }
        }
        if (empty($data['solar_appraisal_apply_ids']) && empty($data['family_solar_appraisal_apply_ids'])){
                $chooseAppraisalResult = false;
        }
        $validator->after(static function ($validator) use ($pdfResult, $bookbindingNames1Result, $bookbindingNames2Result,$chooseAppraisalResult) {
            if ($pdfResult === false) {
                $validator->errors()->add('solar_pdf_types', '表紙デザインを選択してください');
            }
            if ($bookbindingNames1Result === false || $bookbindingNames2Result === false) {
                $validator->errors()->add('solar_bookbinding_names', '表紙に表示したい名前を入力してください');
            }
            if ($chooseAppraisalResult === false){
                $validator->errors()->add('choose_solar_appraisal_apply_ids', '鑑定を選択してください');
            }
        });
    }

    public function substitutable(): array
    {
        return $this->all();
    }
}

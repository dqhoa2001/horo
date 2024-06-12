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
        // dd($data);
        if (empty($data['solar_appraisal_apply_ids']) ){
            $validator->errors()->add('personal_solar_appraisal_apply_ids', '鑑定を選択してください');
            return;
        }
        if ( empty($data['family_solar_appraisal_apply_ids'])) {
            $validator->errors()->add('family_solar_appraisal_apply_ids', '鑑定を選択してくださいFamily');
            return;
        }
        $data['select_person'] = AppraisalApply::whereIn('reference_id', $data['person_ids'])->get();
        if (empty($data['person_ids'])) {
            $validator->errors()->add('person_ids', 'レビューブックを印刷したい人を選択してください');
            return;
        }

        $selectedAppraisalId = array_merge($data['solar_appraisal_apply_ids'], $data['family_solar_appraisal_apply_ids']);
        // dd( $selectedAppraisalId);
        $data['select_appraisal_applies'] = AppraisalApply::whereIn('id',$selectedAppraisalId)->get();
        // dd(   $data['select_appraisal_applies'] );

        $data['pdf_types'] = [];
        foreach ($data['select_appraisal_applies'] as $appraisalApply) {
            // dd($appraisalApply);
            foreach ($data as $key => $value) {
                    if (strpos($key, 'pdf_type-') !== false) {
                        $id = str_replace('pdf_type-', '', $key);
                        if ((int) $id === $appraisalApply->reference->id ) {
                            $data['pdf_types'][$appraisalApply->id] = $value;
                        }
                    //   dd(  $data['pdf_types'][$appraisalApply->id]);
                    }
            }
        }
        // dd($data['select_appraisal_applies']);

        // バリデーション
        $pdfResult = true;
        $bookbindingNames1Result = true;
        $bookbindingNames2Result = true;
        $user = auth()->guard('user')->user();
        $familiesWithAppraisalApplies = $user->familiesWithAppraisalApplies();
        if (empty($data['pdf_types'][$appraisalApply->id])) {
                    $pdfResult = false;
        }

        if ($data['bookbinding_names1'][$user->id] === null) {
            $bookbindingNames1Result = false;
        }
        if ($data['bookbinding_names2'][$user->id] === null) {
            $bookbindingNames2Result = false;
        }
        foreach($familiesWithAppraisalApplies as $family){
            if(isset($data['bookbinding_names1'][$family->id]) && isset($data['bookbinding_names2'][$family->id]) ){
                if ($data['bookbinding_names1'][$family->id] === null) {
                    $bookbindingNames1Result = false;
                }
                if ($data['bookbinding_names2'][$family->id] === null) {
                    $bookbindingNames2Result = false;
                }
            }
        }
        dd($pdfResult);
        $validator->after(static function ($validator) use ($pdfResult, $bookbindingNames1Result, $bookbindingNames2Result) {
            if ($pdfResult === false) {
                $validator->errors()->add('solar_pdf_types', '表紙デザインを選択してください');
            }
            if ($bookbindingNames1Result === false || $bookbindingNames2Result === false) {
                $validator->errors()->add('solar_bookbinding_names', '表紙に表示したい名前を入力してください');
            }
        });
    }

    public function substitutable(): array
    {
        return $this->all();
    }
}

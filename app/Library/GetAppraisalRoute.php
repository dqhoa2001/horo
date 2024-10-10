<?php

namespace App\Library;
use App\Models\AppraisalApply;
use App\Models\User;

class GetAppraisalRoute
{
    // AppraisalApplyモデルのインスタンスを受け取り、個人か家族鑑定かを判定して、URLを返す
    public static function getAppraisalRoute(AppraisalApply $appraisalApply): string
    {
        $appraisalUrl = '';

        if ($appraisalApply->reference_type === User::class) {
            $appraisalUrl = route('user.appraisals.show', $appraisalApply);
        } else {
            $appraisalUrl = route('user.family_appraisals.show', $appraisalApply);
        }
        return $appraisalUrl;
    }
}

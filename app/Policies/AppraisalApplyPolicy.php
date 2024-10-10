<?php

namespace App\Policies;

use App\Models\AppraisalApply;
use App\Models\User;

class AppraisalApplyPolicy
{
    //支払い済みでない場合の個人鑑定は見れない
    public function viewClaim(User $user, AppraisalApply $appraisalApply): bool
    {
        return $appraisalApply->appraisalClaim->is_paid;
    }

    // 自分の個人鑑定しか見れない
    public function viewAppraisalApply(User $user, AppraisalApply $appraisalApply): bool
    {
        return $user->id === $appraisalApply->user->id;
    }

    //自身の家族の鑑定しか見れない
    public function viewFamilyAppraisalApply(User $user, AppraisalApply $appraisalApply): bool
    {
        return $user->id === $appraisalApply->reference->user->id;
    }
}

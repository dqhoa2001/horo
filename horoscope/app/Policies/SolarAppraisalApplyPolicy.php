<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SolarApply;

class SolarAppraisalApplyPolicy
{
    //支払い済みでない場合の個人鑑定は見れない
    public function viewSolarClaim(User $user, SolarApply $solarApply): bool
    {
        return $solarApply->solarClaim->is_paid;
    }

    // 自分の個人鑑定しか見れない
    public function viewSolarAppraisalApply(User $user, SolarApply $solarApply): bool
    {
        return $user->id === $solarApply->user->id;
    }

    //自身の家族の鑑定しか見れない
    public function viewFamilyAppraisalApply(User $user, SolarApply $appraisalApply): bool
    {
        return $user->id === $appraisalApply->reference->user->id;
    }
}

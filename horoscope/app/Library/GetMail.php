<?php

namespace App\Library;
use App\Models\AppraisalApply;
use App\Models\SolarApply;
use App\Models\User;

class GetMail
{
    //申し込み内容からメールアドレスを取得する
    public static function getMailForApply(AppraisalApply $appraisalApply): string
    {
        $email = '';

        if ($appraisalApply->reference_type === User::class) {
            $email = $appraisalApply->reference->email;
        } else {
            $email = $appraisalApply->reference->user->email;
        }
        return $email;
    }

    public static function getMailForSolarApply(SolarApply $solarApply): string
    {
        $email = '';

        if ($solarApply->reference_type === User::class) {
            $email = $solarApply->reference->email;
        } else {
            $email = $solarApply->reference->user->email;
        }
        return $email;
    }
}

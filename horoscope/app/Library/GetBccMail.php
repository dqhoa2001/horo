<?php

namespace App\Library;
use App\Models\User;
use App\Models\AdminMail;
use App\Models\AppraisalApply;

class GetBccMail
{
    //申し込み内容からメールアドレスを取得する
    public static function getBccMail(): array
    {
        $allAdminMailAddresses = AdminMail::pluck('email')->toArray();
        $minnaBcc = config('mail.minna_bcc');
        $minnaBccArray = [$minnaBcc]; // 文字列を配列に変換
        $bccMails = array_merge($allAdminMailAddresses, $minnaBccArray);

        return $bccMails;
    }
}

<?php

namespace App\Services;

use App\Library\GetGeocoding;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;
use Carbon\Carbon;

class FamilyService
{
    // ホロスコープ作成に必要な情報の登録
    public static function create(Request $request): Family
    {
        $family = new Family();
        $family->name1 = $request->name1;
        $family->name2 = $request->name2;
        $family->relationship = $request->relationship;
        $family->user_id = auth()->guard('user')->user()->id;
        $family->birthday = Carbon::parse($request->birth);
        $family->birthday_time = $request->time;
        $family->birthday_prefectures = $request->birthday_prefectures;
        $family->birthday_city = $request->birthday_city ?? null;
        $family->timezome = $request->timezone;
        $family->longitude = $request->longitude;
        $family->latitude = $request->latitude;
        $family->save();
        return $family;
    }

    // 更新
    public static function update(array $param, Family $family): void
    {
        $family->name1 = $param['name1'];
        $family->name2 = $param['name2'];
        $family->relationship = $param['relationship'];
        $family->birthday = Carbon::parse($param['birthday']);
        $family->birthday_time = $param['time'];
        $family->birthday_prefectures = $param['birthday_prefectures'];
        $family->birthday_city = $param['birthday_city'] ?? null;
        $family->timezome = $param['timezone'];
        $family->longitude = $param['longitude'];
        $family->latitude = $param['latitude'];
        $family->save();
    }

    // 会員登録と同時に家族情報を登録用のメソッド
    public static function createForAppraosal(Request $request, User $user): Family
    {
        $family = new Family();
        $family->name1 = $request->family_name1;
        $family->name2 = $request->family_name2;
        $family->relationship = $request->relationship;
        $family->user_id = $user->id;
        $family->birthday = Carbon::parse($request->birthday);
        $family->birthday_time = $request->birthday_time;
        $family->birthday_prefectures = $request->birthday_prefectures;
        $family->birthday_city = $request->birthday_city ?? null;
        $family->timezome = $request->timezone;

        //軽度緯度の取得(TODO: 海外時にはここを変更する？)
        $family->longitude = $request->longitude;
        $family->latitude = $request->latitude;
        $family->save();

        return $family;
    }

    // 個人鑑定で家族登録
    public static function updateOrCreate(Request $request): Family
    {
        $family = Family::updateOrCreate(
            [
                'id' => $request->family_id,
            ],
            [
                'id'                   => $request->family_id,
                'user_id'              => auth()->guard('user')->user()->id,
                'name1'                => $request->name1,
                'name2'                => $request->name2,
                'relationship'         => $request->relationship,
                'birthday'             => Carbon::parse($request->birthday),
                'birthday_time'        => $request->birthday_time,
                'birthday_prefectures' => $request->birthday_prefectures,
                'birthday_city'        => $request->birthday_city ?? null,
                'longitude'            => $request->longitude,
                'latitude'             => $request->latitude,
                'timezome'             => $request->timezone,
            ]
        );
        return $family;
    }

    // 家族鑑定申し込み済みかどうか判定
    public static function isAppraisalClaimed(Family $family): bool
    {
        return Family::query()->where('id', $family->id)->whereHas('appraisalApplies.appraisalClaim')->exists();
    }
}

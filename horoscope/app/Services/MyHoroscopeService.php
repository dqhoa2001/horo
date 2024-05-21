<?php

namespace App\Services;

use App\Library\GetGeocoding;
use Illuminate\Http\Request;

class MyHoroscopeService
{
    // マイホロスコープ作成に必要な情報の登録
    public static function createOrUpdateHoroscope(array $param): void
    {
        $user = auth()->guard('user')->user();
        //birthdayは/区切りで入ってくるので、-区切りに変換
        $user->birthday = str_replace('/', '-', $param['birthday']);
        $user->birthday_time = $param['time'];
        $user->birthday_prefectures = $param['birthday_prefectures'];
        $user->birthday_city = $param['birthday_city'] ?? null;
        $user->longitude = $param['longitude'];
        $user->latitude = $param['latitude'];
        $user->timezome = $param['timezone'];
        $user->save();
    }

    // 個人鑑定で登録する際にusersにもホロスコープの情報を更新する
    public static function update(Request $request): void
    {
        $user = auth()->guard('user')->user();
        //birthdayは/区切りで入ってくるので、-区切りに変換
        $user->birthday = $request->birthday;
        $user->birthday_time = $request->birthday_time;
        $user->birthday_prefectures = $request->birthday_prefectures;
        $user->birthday_city = $request->birthday_city ?? null;
        $user->longitude = $request->longitude;
        $user->latitude = $request->latitude;
        $user->timezome = $request->timezone;
        $user->save();
    }
}

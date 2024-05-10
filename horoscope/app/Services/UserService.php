<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Library\GetGeocoding;
use Illuminate\Http\Request;

class UserService
{
    // 検索
    public static function search(array $input): Builder
    {
        $query = User::query()->withTrashed();

        if (isset($input['general']) || isset($input['influencer']) || isset($input['withdraw']) || isset($input['userBookbindings'])) {
            $query->where(static function ($query) use ($input) {
                if (isset($input['general'])) {
                    // 退会すみのユーザーは除外
                    $query->orWhere('member_type', User::GENERAL)->where('deleted_at', null);
                }

                if (isset($input['influencer'])) {
                    $query->orWhere('member_type', User::INFLUENCER)->where('deleted_at', null);
                }

                if (isset($input['withdraw'])) {
                    $query->orWhere('deleted_at', '!=', null);
                }
                if (isset($input['userBookbindings'])) {
                    $query->whereHas('appraisalApplies.bookbindingUserApplies')->get();
                }
            });
        }

        if (isset($input['searchName'])) {
            $query->where(static function ($query) use ($input) {
                $query->whereRaw("CONCAT(name1, name2) LIKE ?", ['%' . $input['searchName'] . '%']);
            });
        }
        if (isset($input['searchEmail'])) {
            $query->where('email', 'like', '%' . $input['searchEmail'] . '%');
        }
        return $query;
    }

    //会員登録して個人鑑定の場合の登録処理
    public static function createUserAndHoroscope(Request $request): User
    {
        $user = User::create([
            'name1' => $request->name1,
            'name2' => $request->name2,
            'kana1' => $request->kana1,
            'kana2' => $request->kana2,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'birthday_prefectures' => $request->birthday_prefectures,
            'birthday_city' => $request->birthday_city ?? null,
            'birthday_time' => $request->birthday_time,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'timezome' => $request->timezone,
            'password' => \Hash::make($request->password),
            'welcome_code' => User::generateUniqueWelcomeCode(),
            'email_verified_at' => now(),
        ]);

        return $user;
    }

    //会員登録のみの場合の登録処理
    public static function create(Request $request): User
    {
        $user = User::create([
            'name1' => $request->name1,
            'name2' => $request->name2,
            'kana1' => $request->kana1,
            'kana2' => $request->kana2,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'welcome_code' => User::generateUniqueWelcomeCode(),
            'email_verified_at' => now(),
        ]);

        return $user;
    }

    //クーポンが入力されている場合、point_sumから差し引く
    public static function subtractionDiscountPrice(int $discountPrice): void
    {
        $user = auth()->guard('user')->user();
        $user->point_sum -= $discountPrice;
        $user->save();
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MyHoroscopeController\StoreRequest;
use App\Http\Requests\User\MyHoroscopeController\UpdateRequest;
use App\Models\Appraisal;
use App\Models\AppraisalApply;
use App\Models\MyHoroscope;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use Modules\Horoscope\Http\Requests\HoroscopeRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\MyHoroscopeService;
use App\Services\SolarComboboxService;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Horoscope\Http\Actions\GenerateSolarHoroscopeChartAction;

class MyHoroscopeController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected GenerateSolarHoroscopeChartAction $generateSolarHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
    ) {
    }

    // マイホロスコープ作成画面
    public function create(): View
    {
        // return view('user.my_horoscopes.create');
        $defaultBirthDay = auth()->guard('user')->user()->birthday;
        return view('user.my_horoscopes.create', [
            'defaultBirthDay' => $defaultBirthDay,
        ]);
    }

    // 登録処理
    public function store(StoreRequest $request): RedirectResponse
    {
        // ホロスコープ生成なデータを作成
        try {
            MyHoroscopeService::createOrUpdateHoroscope($request->substitutable());
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの生成に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', 'ホロスコープの生成に失敗しました。時間をあけて再度お試しください。')->withInput();
        }

        return to_route('user.my_horoscopes.edit')->with('status', 'ホロスコープを作成しました！');
    }

    // 編集フォーム表示
    public function edit(): View
    {
        $user = auth()->guard('user')->user();
        // ホロスコープ生成なデータを作成
        $formData = [
            "name" => $user->name1 . $user->name2,
            "year" => $user->birthday->format('Y'),
            "month" => $user->birthday->format('m'),
            "day" => $user->birthday->format('d'),
            "hour" => $user->birthday_time->format('H'),
            "minute" => $user->birthday_time->format('i'),
            "longitude" => $user->longitude,
            "latitude" => $user->latitude,
            "map-city" => $user->birthday_city,
            "timezone" => $user->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
        ];
        $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $image = $chart->get('image');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $imgBase64 = base64_encode($image->getImageBlob());
        $defaultBirthdayPrefectures = $user->birthday_prefectures ?? '東京都杉並区';
        $defaultAddress = $defaultBirthdayPrefectures;
        $defaultBirthDay = $user->birthday;
        $solarAppraisals =  SolarComboboxService::SolarCombobox($user->id,User::class);
        return view('user.my_horoscopes.edit', [
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'defaultAddress' => $defaultAddress,
            'defaultBirthDay' => $defaultBirthDay,
            'solarAppraisals' => $solarAppraisals,
        ]);
    }

    //HoroSolar
    public function show(AppraisalApply $solar_apply): View
    {
        $user = auth()->guard('user')->user();
        // ホロスコープ生成なデータを作成
        $formData = [
            "name" => $user->name1 . $user->name2,
            "year" => $solar_apply->birthday->format('Y'),
            "month" => $solar_apply->birthday->format('m'),
            "day" => $solar_apply->birthday->format('d'),
            "hour" => $solar_apply->birthday_time->format('H'),
            "minute" => $solar_apply->birthday_time->format('i'),
            "longitude" => $solar_apply->longitude,
            "latitude" => $solar_apply->latitude,
            "map-city" => $solar_apply->birthday_prefectures,
            "timezone" => $solar_apply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
            "solar_year"=> $solar_apply->solar_return,
        ];
        $chart = $this->generateSolarHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $image = $chart->get('image');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $imgBase64 = base64_encode($image->getImageBlob());
        $defaultBirthdayPrefectures = $user->birthday_prefectures ?? '東京都杉並区';
        $defaultAddress = $defaultBirthdayPrefectures;
        $defaultBirthDay = $user->birthday;
        $solarAppraisals =  SolarComboboxService::SolarCombobox($user->id,User::class);
        $solar_return = $solar_apply->solar_return + 1;
        $birthday = $solar_apply->birthday;
        $birthdayDate = \Carbon\Carbon::parse($birthday);
        $birthdayTime = $solar_apply->birthday_time;
        $birthdayTime = new \DateTime($birthdayTime);
        $birthHour = $birthdayTime->format('H');
        $birthMinute = $birthdayTime->format('i');
        $age = $solar_return - $birthdayDate->year;
        if (\Carbon\Carbon::now()->isBefore($birthdayDate->copy()->year($solar_return)->endOfYear())) {
            $age--;
            $solar_return--;
        }
        $currentYearFormattedDate = $birthdayDate->copy()->year($solar_return)->format('Y年m月d日');
        $nextYearEndDate = $birthdayDate->copy()->year($solar_return + 1)->subDay()->format('Y年m月d日');
        $formattedAge = $age .'歳　'.$currentYearFormattedDate. ' ~ ' .$nextYearEndDate;
        $formattedAge1 = '太陽回帰年月日　' . $solar_return.'年' . $birthdayDate->month . '月' . $birthdayDate->day . '日　' .  $birthHour . '時' . $birthMinute . '分';

        return view('user.my_horoscopes.edit', [
            'solarApply' => $solar_apply,
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'defaultAddress' => $defaultAddress,
            'defaultBirthDay' => $defaultBirthDay,
            'solarAppraisals' => $solarAppraisals,
            'formattedAge' => $formattedAge,
            'formattedAge1' => $formattedAge1,
        ]);
    }
    public function update(UpdateRequest $request): RedirectResponse
    {
        try {
            MyHoroscopeService::createOrUpdateHoroscope($request->substitutable());
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの生成に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', 'ホロスコープの生成に失敗しました。時間をあけて再度お試しください。')->withInput();
        }

        return back()->with('status', '更新しました');
    }

    /**
     * 削除
     *
     * @param MyHoroscope $myHoroscope
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MyHoroscope $myHoroscope)
    {
        $myHoroscope->delete();

        return to_route('user.my_horoscopes.index')->with('status', '削除しました');
    }
}

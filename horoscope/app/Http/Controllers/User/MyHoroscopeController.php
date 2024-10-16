<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MyHoroscopeController\StoreRequest;
use App\Http\Requests\User\MyHoroscopeController\UpdateRequest;
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
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;

class MyHoroscopeController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
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

        // ホロスコープ占いの処理
        // $formData = $request->validated();
        // $localtion = $this->modifyLocation->execute($formData['longitude'], $formData['latitude']);
        $chart = $this->generateHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        // $zodiacColors = WheelColorEnum::ZodiacElement;
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

        return view('user.my_horoscopes.edit', [
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'defaultAddress' => $defaultAddress,
            'defaultBirthDay' => $defaultBirthDay,
        ]);
    }

    //出生情報更新
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

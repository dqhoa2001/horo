<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\User\FamilyController\StoreRequest;
use App\Http\Requests\User\FamilyController\UpdateRequest;
use App\Models\AppraisalApply;
use App\Models\Family;
use App\Services\FamilyService;
use Illuminate\Http\RedirectResponse;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Modules\Horoscope\Http\Actions\GenerateSolarHoroscopeChartAction;

class FamilyController extends Controller
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
        protected SolarAppraisalApplyService $solarAppraisalApplyService,
    ) {
    }

    // 家族のホロスコープ一覧
    public function index(): View
    {
        return view('user.families.index', [
            'families' => auth()->guard('user')->user()->families()->get(),
        ]);
    }

    // 家族のホロスコープ作成
    public function create(): View
    {
        return view('user.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        // ホロスコープ生成なデータを作成
        try {
            $request->merge([
                'birth' => $request->birth_year . '/' . $request->birth_month . '/' . $request->birth_day,
            ]);
            FamilyService::create($request);
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの生成に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', 'ホロスコープの生成に失敗しました。時間をあけて再度お試しください。')->withInput();
        }
        return to_route('user.families.index')->with('status', 'ホロスコープを作成しました！');
    }

    // 家族のホロスコープ表示と編集
    public function edit(Request $request, Family $family, SolarApply $solarApply): View
    {
        // dd($family);
        $user = auth()->guard('user')->user();
        if ($request->input('solar_date')) {
            $solarDate = $request->input('solar_date');
            // dd($request);
            $solarDates = $user->solarApplies()
            ->whereHas('solarClaim', static function ($query) {
                $query->where('is_paid', true);
            })
            ->orderBy('id', 'desc')
            ->pluck('solar_date')
            ->toArray();
            if (in_array($solarDate, $solarDates)) {
                try {
                    $formData = [
                        "name" => $family->name1 . $family->name2,
                        "year" => $solarDate,
                        "month" => $family->birthday->format('m'),
                        "day" => $family->birthday->format('d'),
                        "hour" => $family->birthday_time->format('H'),
                        "minute" => $family->birthday_time->format('i'),
                        "longitude" => $family->longitude,
                        "latitude" => $family->latitude,
                        "map-city" => $family->birthday_city,
                        "timezone" => $family->timezome,
                        "background" => 'normal',
                    ];
                    // dd($formData);

                } catch (\Exception $e) {
                    abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            $formData = [
                "name" => $family->name1 . $family->name2,
                "year" => $family->birthday->format('Y'),
                "month" => $family->birthday->format('m'),
                "day" => $family->birthday->format('d'),
                "hour" => $family->birthday_time->format('H'),
                "minute" => $family->birthday_time->format('i'),
                "longitude" => $family->longitude,
                "latitude" => $family->latitude,
                "map-city" => $family->birthday_city,
                "timezone" => $family->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
                "background" => 'normal', //仮
            ];
            // dd($formData);
        }
        // ホロスコープ生成なデータを作成
        // $formData = [
        //     "name" => $family->name1 . $family->name2,
        //     "year" => $family->birthday->format('Y'),
        //     "month" => $family->birthday->format('m'),
        //     "day" => $family->birthday->format('d'),
        //     "hour" => $family->birthday_time->format('H'),
        //     "minute" => $family->birthday_time->format('i'),
        //     "longitude" => $family->longitude,
        //     "latitude" => $family->latitude,
        //     "map-city" => $family->birthday_city,
        //     "timezone" => $family->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
        //     "background" => 'normal', //仮
        // ];

        // ホロスコープ占いの処理
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

        $defaultBirthdayPrefectures = $family->birthday_prefectures ?? '東京都千代田区';
        $defaultAddress = $defaultBirthdayPrefectures;
        $defaultBirthDay = $family->birthday;
        $isAppraisalClaimed = $family->appraisalApplies()->whereHas('appraisalClaim')->exists();

        // $selectedSolarDate = $request->input('solar_date', null);
        // if ($selectedSolarDate) {
        //     $solarApply = SolarApply::where('solar_date', $selectedSolarDate)
        //                             ->where('reference_id', auth()->guard('user')->user()->id)
        //                             ->first();
        //     if ($solarApply) {
        //         $url = url("user/families/{$solarApply->id}/edit/?solar_date={$selectedSolarDate}");
        //         return view('user.families.edit')->with('redirect_url', $url);
        //     }
        // }
        // $solarAppraisalResultData = $this->solarAppraisalApplyService->createSolarAppraisalResultData($solarApply);
        $user = auth()->guard('user')->user();
        $userBirthday = User::where('id', $user->id)->value('birthday');
        $userBirthYear = date('Y', strtotime($userBirthday));
        // $solarYear = date('Y', strtotime($solarAppraisalResultData['solarDate']));
        // $age = $solarYear - $userBirthYear;
        // $solarDates = $user->solarApplies()
        //     ->whereHas('solarClaim', static function ($query) {
        //         $query->where('is_paid', true);
        //     })
        //     ->orderBy('id', 'desc')
        //     ->pluck('solar_date');
        $solarDates = $user->solarApplies()
            ->with('family')
            ->whereHas('solarClaim', static function ($query) {
                $query->where('is_paid', true);
                $query->where('reference_type', "App\Models\User");
            })
            ->orderBy('id', 'desc')
            ->pluck('solar_date');
        $birthday = User::where('id', $user->id)->value('birthday');
        // $birthday_time = User::where('id', $user->id)->value('birthday_time');
        // $birthday_prefectures = User::where('id', $user->id)->value('birthday_prefectures');
        return view('user.families.edit', [
            'family'     => $family,
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'defaultAddress' => $defaultAddress,
            'defaultBirthDay' => $defaultBirthDay,
            'isAppraisalClaimed' => $isAppraisalClaimed,
            'solarAppraisals' => AppraisalApply::whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->where('reference_type', Family::class)
            ->where('reference_id', $family->id)
            ->where('solar_return', '!=', 0)->get(),
        ]);
    }
    public function show(Family $family,AppraisalApply $solar_apply): View
    {
        // ホロスコープ生成なデータを作成
        $formData = [
            "name" => $family->name1 . $family->name2,
            "year" => $solar_apply->solar_return,
            "month" => $solar_apply->birthday->format('m'),
            "day" => $solar_apply->birthday->format('d'),
            "hour" => $solar_apply->birthday_time->format('H'),
            "minute" => $solar_apply->birthday_time->format('i'),
            "longitude" => $solar_apply->longitude,
            "latitude" => $solar_apply->latitude,
            "map-city" => $solar_apply->birthday_city,
            "timezone" => $solar_apply->timezome, //海外展開時にはここが変更できるようにする。現在は日本のみ
            "background" => 'normal', //仮
        ];
        $chart = $this->generateSolarHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodiacs = $this->zodiacRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $image = $chart->get('image');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        $imgBase64 = base64_encode($image->getImageBlob());
        $defaultBirthdayPrefectures = $family->birthday_prefectures ?? '東京都杉並区';
        $defaultAddress = $defaultBirthdayPrefectures;
        $defaultBirthDay = $family->birthday;
        $isAppraisalClaimed = $family->appraisalApplies()->whereHas('appraisalClaim')->exists();
        return view('user.families.edit', [
            'family'     => $family,
            'solarApply' => $solar_apply,
            'imgBase64'  => $imgBase64,
            'degreeData' => $degreeData,
            'explain'    => $explain,
            'zodiacs'    => $zodiacs,
            'planets'    => $planets,
            'houses'     => $houses,
            'defaultAddress' => $defaultAddress,
            'defaultBirthDay' => $defaultBirthDay,
            'isAppraisalClaimed' => $isAppraisalClaimed,
            'solarAppraisals' => AppraisalApply::whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->where('reference_type', $solar_apply->reference_type)
            ->where('reference_id', $solar_apply->reference_id)
            ->where('solar_return', '!=', 0)->get(),
        ]);
    }
    // 家族のホロスコープ更新
    public function update(UpdateRequest $request, Family $family): RedirectResponse
    {
        // ホロスコープ生成なデータを作成
        try {
            FamilyService::update($request->substitutable(), $family);
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの生成に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', '家族情報の修正に失敗しました。時間をあけて再度お試しください。')->withInput();
        }
        return back()->with('status', '家族情報を修正しました！');

    }

    /**
     * 家族のホロスコープ削除
     *
     * @param Family $family
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Family $family): RedirectResponse
    {
        // ホロスコープ生成データの削除
        try {
            $isClaimed = FamilyService::isAppraisalClaimed($family);
            if (!$isClaimed) {
                $family->delete();
            } else {
                \Log::warning("ホロスコープが既に削除にされています。");
                return back()->with('flash_alert', 'ホロスコープが既に削除にされています。')->withInput();
            }
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの削除に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', 'ホロスコープの削除に失敗しました。時間をあけて再度お試しください。')->withInput();
        }
        return to_route('user.families.index')->with('status', '家族のホロスコープを削除しました');
    }
}

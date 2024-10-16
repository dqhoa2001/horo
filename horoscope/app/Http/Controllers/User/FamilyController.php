<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\User\FamilyController\StoreRequest;
use App\Http\Requests\User\FamilyController\UpdateRequest;
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

class FamilyController extends Controller
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
    public function edit(Family $family): View
    {
        // ホロスコープ生成なデータを作成
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
            'isAppraisalClaimed' => $isAppraisalClaimed
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

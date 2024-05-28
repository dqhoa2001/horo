<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AppraisalApply;
use App\Models\User;
use App\Services\AppraisalApplyService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Appraisal;
use App\Models\Bookbinding;
use App\Http\Requests\User\MySolarHoroscopeController\UpdateRequest;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use App\Repositories\ZodiacRepository;
use App\Services\MyHoroscopeService;
use Modules\Horoscope\Http\Actions\GenerateSolarHoroscopeChartAction;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Carbon\Carbon;

class SolarAppraisalController extends Controller
{
    public function __construct(
        protected AppraisalApplyService $appraisalApplyService,
        protected GenerateSolarHoroscopeChartAction $generateSolarHoroscopeChartAction,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected SabianPatternRepository $sabianPatternRepository
    ) {}

    public function index(Request $request): View|RedirectResponse
    {
        $latestAppraisalApply = AppraisalApply::whereHas('user', static function ($query) {
            $query->where('id', auth()->guard('user')->user()->id);
        })->whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->where('reference_type', User::class)->latest()->first();
       // dd($latestAppraisalApply);
        // 鑑定結果がある場合showへリダイレクト
        if ($latestAppraisalApply) {
            return to_route('user.solar_appraisals.show', $latestAppraisalApply);
        }

        return view('user.appraisals.index', [
            'appraisal'         => Appraisal::where('is_enabled', true)->first(),
            'bookbinding'       => Bookbinding::where('is_enabled', true)->first(),
        ]);
    }

    public function show(AppraisalApply $appraisalApply): View
    {
        $user = auth()->guard('user')->user();
        $solarDates = $user->solarApplies()
            ->whereHas('solarClaim', static function ($query) {
                $query->where('is_paid', true);
            })
            ->orderBy('id', 'desc')
            ->pluck('solar_date');;
        // dd($solarDate1);
        $birthday = $user->birthday;
        $selectedYear = request('solar_date', now()->year);
        // dd($selectedYear);
        $age = Carbon::parse($selectedYear)->diffInYears($birthday);
        $formData = [
            "name" => $user->name1 . $user->name2,
            "year" => $user->solar_date ?? now()->year,
            "month" => $user->birthday->format('m'),
            "day" => $user->birthday->format('d'),
            "hour" => $user->birthday_time->format('H'),
            "minute" => $user->birthday_time->format('i'),
            "longitude" => $user->longitude,
            "latitude" => $user->latitude,
            "map-city" => $user->birthday_city,
            "timezone" => $user->timezome,
            "background" => 'normal',
        ];
        $chart = $this->generateSolarHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
        $zodiacs = $this->zodiacPatternRepository->getAll();
        $planets = $this->planetRepository->getAll();
        $houses = $this->houseRepository->getAll();
        $sabian = $this->sabianPatternRepository->getAll();
        $solarDate = $chart->get('solarDate');
        $degreeData = $chart->get('degreeData');
        $explain = $chart->get('explain');
        return view('user.solar_appraisals.show', [
            'appraisalApply'      => $appraisalApply,
            'degreeData'          => $degreeData,
            'explain'             => $explain,
            'zodaics'             => $zodiacs,
            'planets'             => $planets,
            'houses'              => $houses,
            'zodaicsPattern'      => $zodiacs,
            'sabian'              => $sabian,
            'solarDate'           => $solarDate,
            'solarDates'          => $solarDates,
            'age'                 => $age,
            'selectedYear'        => $selectedYear,
        ]);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        try {
            MyHoroscopeService::updateSorlarDate($request);
        } catch (\Throwable $th) {
            \Log::warning("ホロスコープの生成に失敗しました。原因：{$th->getMessage()}");
            return back()->with('flash_alert', 'ホロスコープの生成に失敗しました。時間をあけて再度お試しください。')->withInput();
        }

        return back()->with('status', '更新しました');
    }
}

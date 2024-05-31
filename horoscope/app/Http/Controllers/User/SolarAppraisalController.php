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
use App\Models\SolarApply;
use App\Services\SolarAppraisalApplyService;
use App\Models\Solar;
use Carbon\Carbon;

class SolarAppraisalController extends Controller
{
    public function __construct(
        protected AppraisalApplyService $appraisalApplyService,
        protected GenerateSolarHoroscopeChartAction $generateSolarHoroscopeChartAction,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected SabianPatternRepository $sabianPatternRepository,
        protected SolarAppraisalApplyService $solarAppraisalApplyService,
    ) {}

    public function index(Request $request): View|RedirectResponse
    {
        return view('user.solar_appraisals.index', [
            'SolarAppraisals' => SolarApply::whereHas('user', static function ($query) {
                $query->where('id', auth()->guard('user')->user()->id);
            })->whereHas('solarClaim', static function ($query) {
                $query->where('is_paid', true);
            })->where('reference_type', User::class)->get(),
            'solar_appraisal'         => Solar::where('is_enabled', true)->first(),
            'bookbinding'       => Bookbinding::where('is_enabled', true)->first(),
        ]);
    }

    //show solar appraisal data
    public function show(Request $request, SolarApply $solarApply): View
    {
        $selectedSolarDate = $request->input('solar_date', null);
        if ($selectedSolarDate) {
            $solarApply = SolarApply::where('solar_date', $selectedSolarDate)
                                    ->where('reference_id', auth()->guard('user')->user()->id)
                                    ->first();
        }
        $solarAppraisalResultData = $this->solarAppraisalApplyService->createSolarAppraisalResultData($solarApply);
        $user = auth()->guard('user')->user();
        $userBirthday = User::where('id', $user->id)->value('birthday');
        $userBirthYear = date('Y', strtotime($userBirthday));
        // $solarYear = date('Y', strtotime($solarAppraisalResultData['solarDate']));
        // $age = $solarYear - $userBirthYear;
        $solarDates = $user->solarApplies()
            ->whereHas('solarClaim', static function ($query) {
                $query->where('is_paid', true);
            })
            ->orderBy('id', 'desc')
            ->pluck('solar_date');;
        $birthday = User::where('id', $user->id)->value('birthday');
        $birthday_time = User::where('id', $user->id)->value('birthday_time');
        $birthday_prefectures = User::where('id', $user->id)->value('birthday_prefectures');
        return view('user.solar_appraisals.show', [
            'solarApply'          => $solarApply,
            'degreeData'          => $solarAppraisalResultData['degreeData'],
            'explain'             => $solarAppraisalResultData['explain'],
            'zodaics'             => $solarAppraisalResultData['zodaics'],
            'planets'             => $solarAppraisalResultData['planets'],
            'houses'              => $solarAppraisalResultData['houses'],
            'zodaicsPattern'      => $solarAppraisalResultData['zodaicsPattern'],
            'sabian'              => $solarAppraisalResultData['sabian'],
            'solarDate'           => $solarAppraisalResultData['solarDate'],
            'solarDates'          => $solarDates,
            'userBirthYear'       => $userBirthYear,
            'birthday'            => $birthday,
            'birthday_time'            => $birthday_time,
            'birthday_prefectures'            => $birthday_prefectures,
        ]);
    }

    // public function show(AppraisalApply $appraisalApply): View
    // {
    //     $user = auth()->guard('user')->user();
    //     $formData = [
    //         "name" => $user->name1 . $user->name2,
    //         "year" => $user->solar_date ?? now()->year,
    //         "month" => $user->birthday->format('m'),
    //         "day" => $user->birthday->format('d'),
    //         "hour" => $user->birthday_time->format('H'),
    //         "minute" => $user->birthday_time->format('i'),
    //         "longitude" => $user->longitude,
    //         "latitude" => $user->latitude,
    //         "map-city" => $user->birthday_city,
    //         "timezone" => $user->timezome,
    //         "background" => 'normal',
    //     ];
    //     $chart = $this->generateSolarHoroscopeChartAction->execute($formData, WheelRadiusEnum::WheelScale);
    //     $zodiacs = $this->zodiacPatternRepository->getAll();
    //     $planets = $this->planetRepository->getAll();
    //     $houses = $this->houseRepository->getAll();
    //     $sabian = $this->sabianPatternRepository->getAll();
    //     $solarDate = $chart->get('solarDate');
    //     $degreeData = $chart->get('degreeData');
    //     $explain = $chart->get('explain');
    //     return view('user.solar_appraisals.show', [
    //         'appraisalApply'      => $appraisalApply,
    //         'degreeData'          => $degreeData,
    //         'explain'             => $explain,
    //         'zodaics'             => $zodiacs,
    //         'planets'             => $planets,
    //         'houses'              => $houses,
    //         'zodaicsPattern'      => $zodiacs,
    //         'sabian'              => $sabian,
    //         'solarDate'           => $solarDate
    //     ]);
    // }

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

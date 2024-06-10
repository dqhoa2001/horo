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
use App\Services\SolarAppraisalApplyService;
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

    public function index(): View|RedirectResponse
    {
        return view('user.solar_appraisals.index', [
            'solarAppraisals' => AppraisalApply::whereHas('user', static function ($query) {
                $query->where('id', auth()->guard('user')->user()->id);
            })->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->where('reference_type', User::class)->where('solar_return', '!=', 0)->get(),
            'solar_appraisal'         => Appraisal::where('is_enabled', true)->where('solar_return',true)->first(),
            'bookbinding'       => Bookbinding::where('is_enabled', true)->where('solar_return',true)->first(),
        ]);
    }

    //show solar appraisal data
    public function show(AppraisalApply $solar_apply): View
    {
        $solarAppraisals = AppraisalApply::whereHas('appraisalClaim', static function ($query) {
            $query->where('is_paid', true);
        })->where('reference_type', $solar_apply->reference_type)
        ->where('reference_id', $solar_apply->reference_id)
        ->where('solar_return', '!=', 0)->get();
        $solarAppraisalResultData = $this->solarAppraisalApplyService->createSolarAppraisalResultData($solar_apply);
        return view('user.solar_appraisals.show', [
            'solarApply'          => $solar_apply,
            'solarAppraisals'     =>  $solarAppraisals,
            'degreeData'          => $solarAppraisalResultData['degreeData'],
            'explain'             => $solarAppraisalResultData['explain'],
            'zodaics'             => $solarAppraisalResultData['zodaics'],
            'planets'             => $solarAppraisalResultData['planets'],
            'houses'              => $solarAppraisalResultData['houses'],
            'zodaicsPattern'      => $solarAppraisalResultData['zodaicsPattern'],
            'sabian'              => $solarAppraisalResultData['sabian'],
            'solarDate'           => $solarAppraisalResultData['solarDate'],
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

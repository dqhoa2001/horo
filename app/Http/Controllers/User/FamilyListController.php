<?php

namespace App\Http\Controllers\User;

use App\Models\Family;
use App\Models\Appraisal;
use Illuminate\View\View;
use App\Models\Bookbinding;
use App\Models\AppraisalApply;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use App\Services\AppraisalApplyService;
use Modules\Horoscope\Enums\ExplainEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;

class FamilyListController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected AppraisalApplyService $appraisalApplyService
    ) {}

    //家族鑑定一覧
    public function index(): View
    {
        return view('user.family_list.index', [
            'families'=> Family::where('user_id', auth()->guard('user')->user()->id)->get(),
        ]);
    }

    //家族鑑定詳細
    public function show(AppraisalApply $appraisalApply): View
    {
        $appraisalResultData = $this->appraisalApplyService->createAppraisalResultData($appraisalApply);

        return view('user.family_appraisals.show', [
            'appraisalApply'      => $appraisalApply,
            'degreeData'          => $appraisalResultData['degreeData'],
            'explain'             => $appraisalResultData['explain'],
            'zodaics'             => $appraisalResultData['zodaics'],
            'planets'             => $appraisalResultData['planets'],
            'houses'              => $appraisalResultData['houses'],
            'zodaicsPattern'      => $appraisalResultData['zodaicsPattern'],
            'sabian'              => $appraisalResultData['sabian'],
            'appraisalApplies'    => AppraisalApply::whereHas('family', static function ($query) {
                $query->where('user_id', auth()->guard('user')->user()->id);
            })->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->where('reference_type', Family::class)->get(),
        ]);
    }
}

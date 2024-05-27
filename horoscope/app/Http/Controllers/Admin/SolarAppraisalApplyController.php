<?php

namespace App\Http\Controllers\Admin;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SolarApply;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Repositories\HouseRepository;
use Illuminate\Http\RedirectResponse;
use App\Repositories\PlanetRepository;
use App\Repositories\ZodiacRepository;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Modules\Horoscope\Enums\ExplainEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use App\Repositories\SabianPatternRepository;
use App\Repositories\ZodiacPatternRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\GenerateHoroscopeChartAction;
use App\Http\Requests\Admin\AppraisalApplyController\UpdateRequest;
use App\Models\BookbindingUserApply;
use App\Services\AppraisalApplyService;

class SolarAppraisalApplyController extends Controller
{
    public function __construct(
        protected GenerateHoroscopeChartAction $generateHoroscopeChartAction,
        protected ZodiacRepository $zodiacRepository,
        protected PlanetRepository $planetRepository,
        protected HouseRepository $houseRepository,
        protected ModifyLocation $modifyLocation,
        protected SabianPatternRepository $sabianPatternRepository,
        protected ZodiacPatternRepository $zodiacPatternRepository,
        protected AppraisalApplyService $appraisalApplyService,
    ) {}
    // 鑑定編集
    public function edit(SolarApply $solarApply): View
    {
        // dd($solarApply);
        return view('admin.solar_applies.edit', [
            'solarApply' => $solarApply,
        ]);
    }
}

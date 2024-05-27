<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\SolarApplyService;
use App\Services\SolarClaimService;
use Illuminate\Http\Request;
use App\Models\Bookbinding;
use Illuminate\View\View;

class SolarBookbindingController extends Controller
{
    public function __construct(
        protected SolarClaimService $solarClaimService,
        protected SolarApplyService $solarApplyService,
    ) {}

    // 製本申し込みの表示
    public function create(): View
    {
        $user = auth()->guard('user')->user();

        // 最新の個人鑑定申し込みを取得
        $solarPersonalAppraisal = $user->solarApplies()->whereHas('solarClaim', static function ($query) {
            $query->where('is_paid', true);
        })->orderBy('id', 'desc')->get();
        // dd($personalAppraisal);
        // 家族の個人鑑定を取得

        //個人鑑定製本済数
        $personalBookbindingUserAppliesCount = 0;
        foreach ($user->appraisalApplies as $appraisalApply) {
            if (isset($appraisalApply->bookbindingUserApplies)) {
                foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                    $personalBookbindingUserAppliesCount += 1;
                }
            }
        }
        // dd($solarPersonalAppraisal);
        return view('user.solar_bookbindings.create', [
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'solarPersonalAppraisal' => $solarPersonalAppraisal,
            'personalBookbindingUserAppliesCount' => $personalBookbindingUserAppliesCount,
        ]);
    }

}

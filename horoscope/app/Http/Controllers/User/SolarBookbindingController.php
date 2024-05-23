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
        $personalAppraisal = $user->solarApplies()->whereHas('solarClaim', static function ($query) {
            $query->where('is_paid', true);
        })->orderBy('id', 'desc')->first();

        // 家族の個人鑑定を取得
        $familyAppraisals = $user->families->map(static function ($family) {
            return $family->appraisalApplies()->whereHas('appraisalClaim', static function ($query) {
                $query->where('is_paid', true);
            })->orderBy('id', 'desc')->first();
        })->filter(static function ($family) {
            return null !== $family;
        });

        //個人鑑定製本済数
        $personalBookbindingUserAppliesCount = 0;
        foreach ($user->appraisalApplies as $appraisalApply) {
            if (isset($appraisalApply->bookbindingUserApplies)) {
                foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                    $personalBookbindingUserAppliesCount += 1;
                }
            }
        }

        //家族の個人鑑定製本済数
        $familyBookbindingUserAppliesCount = [];
        foreach ($user->families as $family) {
            $count = 0;
            if (isset($family->appraisalApplies)) {
                foreach ($family->appraisalApplies as $appraisalApply) {
                    if (isset($appraisalApply->bookbindingUserApplies)) {
                        foreach ($appraisalApply->bookbindingUserApplies as $bookbindingUserApply) {
                            $count += 1;
                        }
                    }
                }
            }
            $familyBookbindingUserAppliesCount = $familyBookbindingUserAppliesCount + [$family->id => $count];
        }

        return view('user.bookbindings.create', [
            'bookbinding' => Bookbinding::where('is_enabled', true)->first(),
            'personalAppraisal' => $personalAppraisal,
            'familyAppraisals' => $familyAppraisals,
            'personalBookbindingUserAppliesCount' => $personalBookbindingUserAppliesCount,
            'familyBookbindingUserAppliesCount' => $familyBookbindingUserAppliesCount,
        ]);
    }

}

<?php

namespace App\Services;

use App\Models\AppraisalApply;
use Illuminate\Database\Eloquent\Builder;

class SolarComboboxService
{
    public static function SolarCombobox(int $reference_id, string $reference_type)
    {
        $solarAppraisals = AppraisalApply::whereIn('id', static function ($query) use ($reference_id, $reference_type) {
            $query->selectRaw('MAX(id)')
                ->from('appraisal_applies')
                ->whereExists(static function ($subquery) {
                    $subquery->selectRaw(1)
                        ->from('appraisal_claims')
                        ->whereColumn('appraisal_applies.id', 'appraisal_claims.appraisal_apply_id')
                        ->where('appraisal_claims.is_paid', 1);
                })
                ->where('reference_id', $reference_id)
                ->where('reference_type', $reference_type)
                ->where('solar_return', '!=', 0)
                ->groupBy('solar_return');
        })
            ->orderBy('solar_return')
            ->get();

        return $solarAppraisals;
    }
}

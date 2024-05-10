<?php

namespace Modules\Horoscope\Http\Actions\Explain;

use App\Models\HousePattern;

class GetHousePatternByPlanet
{
    /**
     * @param int $houseId
     * @param int $planetId
     * @return HousePattern|null
     */
    function execute(int $houseId, int $planetId): HousePattern|null
    {
        $pattern = HousePattern::where('house_id', $houseId)
            ->where('planet_id', $planetId)
            ->first();
        return $pattern;
    }
}

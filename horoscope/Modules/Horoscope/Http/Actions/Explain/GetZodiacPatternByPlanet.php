<?php

namespace Modules\Horoscope\Http\Actions\Explain;

use App\Models\ZodiacPattern;

class GetZodiacPatternByPlanet
{
    /**
     * @param int $planetId
     * @param int $zodiacId
     * @return ZodiacPattern|null
     */
    function execute(int $zodiacId, int $planetId): ZodiacPattern|null
    {
        $pattern = ZodiacPattern::where('zodiac_id', $zodiacId)
            ->where('planet_id', $planetId)->first();
        return $pattern;
    }
}

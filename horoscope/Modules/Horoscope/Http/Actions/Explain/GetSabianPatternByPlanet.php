<?php

namespace Modules\Horoscope\Http\Actions\Explain;

use App\Models\SabianPattern;

class GetSabianPatternByPlanet
{
    /**
     * @param int $zodiacId
     * @param int $sabianDegrees
     * @return SabianPattern|null
     */
    function execute(int $zodiacId, int $sabianDegrees): SabianPattern|null
    {
        $pattern = SabianPattern::where('zodiac_id', $zodiacId)
            ->where('sabian_degrees', $sabianDegrees)
            ->first();
        return $pattern;
    }
}

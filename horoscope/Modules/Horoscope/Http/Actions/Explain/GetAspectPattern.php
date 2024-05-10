<?php

namespace Modules\Horoscope\Http\Actions\Explain;

use App\Models\AspectPattern;

class GetAspectPattern
{
    /**
     * @param int $fromPlanetId
     * @param int $toPlanetId
     * @param int $aspectId
     * @return AspectPattern|null
     */
    function execute(
        int $fromPlanetId,
        int $toPlanetId,
        int $aspectId,
    ): AspectPattern|null {
        $pattern = AspectPattern::where('from_planet_id', $fromPlanetId)
            ->where('to_planet_id', $toPlanetId)
            ->where('aspect_id', $aspectId)
            ->first();
        return $pattern;
    }
}

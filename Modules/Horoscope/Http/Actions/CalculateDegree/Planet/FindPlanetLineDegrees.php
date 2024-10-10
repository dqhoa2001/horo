<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\Planet;

use Illuminate\Support\Collection;

class FindPlanetLineDegrees
{
    /**
     *
     *  find line from, to degree planet
     *
     * @param float $ascendant
     * @param Collection $planets
     * @param void
     */
    function execute(
        float $ascendant,
        Collection $planets
    ): Collection {
        $lineFrom = new Collection();
        $lineTo = new Collection();
        $planetLine = new Collection();
        foreach ($planets as $planet) {
            $from = $planet->get('degrees') - $ascendant;
            $to = $planet->get('spot_degrees') - $ascendant;

            $lineFrom->push(collect(['degrees' => $from]));
            $lineTo->push(collect(['degrees' => $to]));
        }

        $planetLine->put('from', $lineFrom);
        $planetLine->put('to', $lineTo);

        return $planetLine;
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\Planet;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;

class FindPlanetSpotDegrees
{
    /**
     *
     *  find degrees after sort planet index
     *
     * @param Collection $planets
     * @param void
     */
    function execute(Collection $planets): void
    {
        $spotList = [];
        $planetSort = $planets->sortByDesc('degrees');
        foreach ($planetSort as $planet) {
            $degree = $planet->get('degrees');
            $houseNum = floor($degree / AngleEnum::Zodiac);
            $fromCusp = $degree - (floor($degree / AngleEnum::Zodiac) * AngleEnum::Zodiac);
            # index on current zodiac (zodiac index from 0 - 5) - 1 zodiac maximun 6 spot
            $indexOnZodiac = floor($fromCusp * AngleEnum::SpotOfZodiac / AngleEnum::Zodiac);

            # index on chart (chart index from 0 - 71 equivalent to 12 zodiac )
            $indexOnChart = $houseNum * AngleEnum::SpotOfZodiac + $indexOnZodiac;

            while (array_key_exists($indexOnChart, $spotList) && $spotList[$indexOnChart] == 1) {
                $indexOnChart--;
            }
            $spotList[$indexOnChart] = 1;

            # recalculation glyph by index on chart
            $spotDegrees = $indexOnChart * (3 * AngleEnum::Zodiac) / (3 * AngleEnum::SpotOfZodiac) + (AngleEnum::Zodiac / (2 * AngleEnum::SpotOfZodiac));
            $planet->put('spot_degrees', $spotDegrees);
            // $planet->put('line_from', $degree - $ascendant);
            // $planet->put('line_to', $spotDegrees - $ascendant);
        }
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;

class FindLineDegrees
{
    /**
     *
     *  find degrees after plus current degrees with angle
     *
     * @param float $currentDegree
     * @param float $angle
     * @param Collection
     */
    function execute(float $ascendant, float $angle): Collection
    {
        $listDegrees = new Collection();
        $startDegree = $ascendant - (floor($ascendant / AngleEnum::Zodiac) * AngleEnum::Zodiac);
        $range = $startDegree + AngleEnum::RangeIgnoreSEPOF;
        for ($i = $startDegree; $i <= $range; $i += $angle) {
            $listDegrees->push(collect([
                'degrees' => $i
            ]));
        }

        return collect($listDegrees);
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;
use Modules\Horoscope\Enums\ZodiacEnum;

class FindZodiacGlyphDegrees
{
    /**
     *
     *  find center zodiac degrees after plus ascendant degrees
     *
     * @param float $ascendant
     * @param Collection
     */
    function execute(float $ascendant): Collection
    {
        $listDegrees = new Collection();
        $zodiacs = ZodiacEnum::getKeys();
        foreach ($zodiacs as $key => $zodiac) {
            $degrees = ($key * AngleEnum::Zodiac) + AngleEnum::HalfZodiac - $ascendant;
            $listDegrees->push(collect([
                'degrees' => $degrees,
            ]));
        }
        // dd($listDegrees, $ascendant);
        return $listDegrees;
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\Planet;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class FindPlanetGlyphDegrees
{
    /**
     *
     *  find degree of planet glyph
     *
     * @param float $ascendant
     * @param Collection $planets
     * @param float $scale,
     * @param bool $useBackground
     * @return Collection
     */
    function execute(
        float $ascendant,
        Collection $planets,
        float $scale,
        bool $useBackground = false,
    ): Collection {
        $planetGlyphs = new Collection();
        $glyphs = new Collection();
        foreach ($planets as $planet) {
            $degrees = $planet->get('spot_degrees') - $ascendant;
            $glyphs->push(collect([
                'degrees' => $degrees,
                'annotation' => $planet->get('annotation'),
            ]));
        }
        $planetGlyphs->put('glyphs', $glyphs);
        $planetGlyphs->put('font_name', resource_path() . FontEnum::Planet);
        $planetGlyphs->put('font_size', FontEnum::PlanetSize * $scale);
        $planetGlyphs->put('color', $useBackground ? WheelColorEnum::PlanetFamily : WheelColorEnum::Planet);
        $planetGlyphs->put('fill_color', $useBackground ? WheelColorEnum::PlanetFamily : WheelColorEnum::Planet);
        return $planetGlyphs;
    }
}

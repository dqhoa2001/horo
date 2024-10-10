<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\House;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class FindHouseGlyphDegree
{
    /**
     *
     *  find house line degree by house angle
     *
     * @param Collection $houseList
     * @param float $scale
     * @param bool $useBackground
     * @return Collection
     */
    function execute(
        Collection $houseLine,
        float $scale,
        bool $useBackground = false
    ): Collection {
        $glyphs = new Collection();
        $houseGlyphs = new Collection();
        foreach ($houseLine as $house) {
            $degree = $house->get('degrees') + ($house->get('angle') / 2);
            $glyphs->push(collect([
                'degrees' => $degree,
                'annotation' => $house->get('annotation'),
            ]));
        }
        $houseGlyphs->put('glyphs', $glyphs);
        $houseGlyphs->put('font_name', resource_path() . FontEnum::House);
        $houseGlyphs->put('font_size', FontEnum::HouseSize * $scale);
        $houseGlyphs->put('color', $useBackground ? WheelColorEnum::HouseFamily : WheelColorEnum::House);
        $houseGlyphs->put('fill_color', $useBackground ? WheelColorEnum::HouseFamily : WheelColorEnum::House);
        return $houseGlyphs;
    }
}

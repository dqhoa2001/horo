<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\House;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;

class FindHouseLineDegree
{
    /**
     *
     *  find house line degree by house angle
     *
     * @param Collection $houseList
     * @param void
     */
    function execute(Collection $houseList): Collection
    {
        $houseLine = new Collection();
        $startDegree = AngleEnum::Zero;
        foreach ($houseList as $house) {
            $houseLine->push(collect([
                'degrees' => $startDegree,
                'angle' => $house->get('angle'),
                'annotation' => $house->get('number'),
            ]));
            $startDegree += $house->get('angle');
        }
        return $houseLine;
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\CalculateDegree\House;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;

class FindHouseAngle
{
    /**
     *
     *  find angle of house from current house degrees with next house degrees
     *
     * @param Collection $houses
     * @param void
     */
    function execute(Collection $houses): void
    {
        foreach ($houses as $key => $house) {
            $houseDegrees = $house->get('degrees');

            if ($house->get('number') == 12) {
                $nextHouseDegrees = $houses->first()->get('degrees');
            } else {
                $nextHouseDegrees = $houses[$key + 1]->get('degrees');
            }

            if ($houseDegrees < AngleEnum::HalfRound) {
                $angle = $nextHouseDegrees - $houseDegrees;
            }

            if (
                $houseDegrees > AngleEnum::HalfRound &&
                $nextHouseDegrees > AngleEnum::HalfRound
            ) {
                $angle = (AngleEnum::Round - $houseDegrees) -
                    (AngleEnum::Round - $nextHouseDegrees);
            }

            if (
                $houseDegrees > AngleEnum::HalfRound &&
                $nextHouseDegrees < AngleEnum::HalfRound
            ) {
                $angle = (AngleEnum::Round - $houseDegrees) +
                    $nextHouseDegrees;
            }

            $house->put('angle', $angle);
        }
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\Convert;

use Illuminate\Support\Collection;

class AddPositionByDegreesAction
{
    /**
     * @param ConvertDegreeToPosition $convertDegreeToPosition
     */
    function __construct(
        protected ConvertDegreeToRadian $convertDegreeToRadian
    ) {
    }

    /**
     * add position to degrees data
     *
     * @param Collection degreesData
     * @return void
     */
    function execute(Collection $degreesData): void
    {
        foreach ($degreesData as $row) {
            if ($row->has('degrees')) {
                $radians = $this->convertDegreeToRadian->execute(
                    $row->get('degrees')
                );
                $row->put('radian_x', $radians->get('x'));
                $row->put('radian_y', $radians->get('y'));
            }
        }
    }
}

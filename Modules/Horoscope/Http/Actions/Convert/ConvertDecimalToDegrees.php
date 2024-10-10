<?php

namespace Modules\Horoscope\Http\Actions\Convert;

use Illuminate\Support\Collection;

class ConvertDecimalToDegrees
{
    /**
     * convert degrees to radian
     *
     * @param float decimal
     * @return Collection
     */
    function execute(float $decimal): Collection
    {
        $degrees = floor($decimal);
        $fullMinute = ($decimal - $degrees) * 60;
        $minnute = floor($fullMinute);
        $second = round(($fullMinute - $minnute) * 60);

        return collect([
            'degrees' => strlen((int)$degrees) > 1 ? (int)$degrees : '0' . (int)$degrees,
            'minnute' => strlen((int) $minnute) > 1 ? (int) $minnute : '0' . (int) $minnute,
            'second' => strlen((int) $second) > 1 ? (int) $second : '0' . (int) $second,
        ]);
    }
}

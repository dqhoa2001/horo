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
            'degrees' => strlen($degrees) > 1 ? $degrees : '0' . $degrees,
            'minnute' => strlen($minnute) > 1 ? $minnute : '0' . $minnute,
            'second' => strlen($second) > 1 ? $second : '0' . $second,
        ]);
    }
}

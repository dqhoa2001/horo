<?php

namespace Modules\Horoscope\Http\Actions\Convert;

use Illuminate\Support\Collection;

class ConvertDegreeToRadian
{
    /**
     * convert degrees to radian
     *
     * @param float degrees
     * @return Collection
     */
    function execute(float $degrees): Collection
    {
        # 1 convert degree -> radian
        $radian = deg2rad($degrees);
        # 2 convert radian -> radian_x, radian_y
        $radians = new Collection();
        $radians->put('x', cos($radian));
        $radians->put('y', sin($radian));

        return $radians;
    }
}

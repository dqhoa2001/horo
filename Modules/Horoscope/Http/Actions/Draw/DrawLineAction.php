<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use ImagickDraw;

class DrawLineAction
{
    /**
     *
     *  add line to draw object
     *
     * @param ImagickDraw $draw
     * @param Collection $lines
     * @param ImagickDraw $draw
     * @param ImagickDraw $draw
     */
    function execute(
        ImagickDraw $draw,
        Collection $lines,
        float $radius,
        float $scale
    ): void {
        foreach ($lines as $key =>  $line) {
            $x = - ($radius * $scale) * $line->get('radian_x');
            $y = - ($radius * $scale) * $line->get('radian_y');
            $draw->line(
                WheelRadiusEnum::WheelCenter * $scale,
                WheelRadiusEnum::WheelCenter * $scale,
                WheelRadiusEnum::WheelCenter * $scale + $x,
                WheelRadiusEnum::WheelCenter * $scale + $y,
            );
        }
    }
}

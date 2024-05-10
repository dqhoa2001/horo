<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use ImagickDraw;
use Modules\Horoscope\Enums\PlanetIndex;

class DrawPlanetLineAction
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
        float $scale,
    ): void {
        $radiusFrom = WheelRadiusEnum::PlanetLineFrom * $scale;
        $radiusTo = WheelRadiusEnum::PlanetLineTo * $scale;
        foreach (PlanetIndex::getKeys() as $key => $planetName) {
            $radianFromX = $lines->get('from')[$key]->get('radian_x');
            $radianFromY = $lines->get('from')[$key]->get('radian_y');
            $radianToX = $lines->get('to')[$key]->get('radian_x');
            $radianToY = $lines->get('to')[$key]->get('radian_y');

            $fromX = -$radiusFrom * $radianFromX;
            $fromY = $radiusFrom * $radianFromY;
            $toX = -$radiusTo * $radianToX;
            $toY = $radiusTo * $radianToY;

            $draw->line(
                WheelRadiusEnum::WheelCenter * $scale + $fromX,
                WheelRadiusEnum::WheelCenter * $scale + $fromY,
                WheelRadiusEnum::WheelCenter * $scale + $toX,
                WheelRadiusEnum::WheelCenter * $scale + $toY,
            );
        }
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use ImagickDraw;
use Modules\Horoscope\Enums\WheelColorEnum;

class DrawAspectLineAction
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
        Collection $aspects,
        float $radius,
        float $scale
    ): void {
        foreach ($aspects as $aspect) {
            $aspectFrom = $aspect->get('from')->first();
            $fromX = - ($radius * $scale) * $aspectFrom->get('radian_x');
            $fromY = ($radius * $scale) * $aspectFrom->get('radian_y');
            $toAspects = $aspect->get('to');
            foreach ($toAspects as $toAspect) {
                $toX = - ($radius * $scale) * $toAspect->get('radian_x');
                $toY = ($radius * $scale) * $toAspect->get('radian_y');
                $draw->setStrokeColor($toAspect->get('color') ?? WheelColorEnum::Line);
                $draw->setStrokeOpacity(1);
                $draw->line(
                    WheelRadiusEnum::WheelCenter * $scale + $fromX,
                    WheelRadiusEnum::WheelCenter * $scale + $fromY,
                    WheelRadiusEnum::WheelCenter * $scale + $toX,
                    WheelRadiusEnum::WheelCenter * $scale + $toY,
                );
            }
        }
    }
}

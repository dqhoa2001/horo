<?php

namespace Modules\Horoscope\Http\Actions\Chart;

use ImagickDraw;
use ImagickPixel;
use Modules\Horoscope\Enums\AngleEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;

class GenerateWheelAction
{
    /**
     *  new eclipse object draw
     * 
     * @param float $scale
     * @param float $radius
     * @param string $fillColor
     * @param bool $border
     * @return ImagickDraw
     */
    function execute(
        float $scale,
        float $radius,
        string $fillColor,
        bool $border = true,
        bool $background = false
    ): ImagickDraw {
        // new wheel draw object
        $draw = new ImagickDraw();
        if (!$background) {
            $draw->setFillColor(new ImagickPixel($fillColor));
        }

        if ($border) {
            $draw->setStrokeColor(new ImagickPixel($background ? WheelColorEnum::WhiteLine : WheelColorEnum::Line));
        }
        // add ellipse to wheel object
        $draw->ellipse(
            WheelRadiusEnum::WheelCenter * $scale,
            WheelRadiusEnum::WheelCenter * $scale,
            $radius * $scale,
            $radius * $scale,
            AngleEnum::Zero,
            AngleEnum::Round
        );

        return $draw;
    }
}
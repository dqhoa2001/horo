<?php

namespace Modules\Horoscope\Http\Actions\Chart;

use Imagick;
use ImagickPixel;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;

class GenerateImageAction
{
    /**
     * new image object
     *
     * @param float scale
     * @return Imagick
     */
    function execute(float $scale)
    {
        $image = new Imagick();
        $image->newImage(
            WheelRadiusEnum::Wheel * $scale,
            WheelRadiusEnum::Wheel * $scale,
            new ImagickPixel(WheelColorEnum::Background)
        );
        $image->setImageFormat('png');

        return $image;
    }
}

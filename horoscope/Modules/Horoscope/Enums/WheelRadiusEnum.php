<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class WheelRadiusEnum extends Enum
{
    # define for wheel drawing
    const WheelScale = 1;
    const WheelScalePDF = 0.8;
    const Wheel = 822 * self::WheelScale;
    const WheelCenter = (self::Wheel / 2);
    const Aura = 340 * self::WheelScale;
    const Outer = 300 * self::WheelScale;
    const Zodiac = 295 * self::WheelScale;
    const Inner = 255 * self::WheelScale;
    const OuterMain = 250 * self::WheelScale;
    const Main = 170 * self::WheelScale;
    const InnerMain = 30 * self::WheelScale;

    const ZeroDegree = 0;
    const RoundDegree = 360;

    # define
    const ZodiacGlyph = 250 * self::WheelScale;
    const PlanetGlyph = 200 * self::WheelScale;
    const PlanetLineFrom = 244 * self::WheelScale;
    const PlanetLineTo = 238 * self::WheelScale;
    const HouseGlyph = 45 * self::WheelScale;
}

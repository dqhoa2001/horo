<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class AngleEnum extends Enum
{
    const Zodiac = 30;
    const HalfZodiac = self::Zodiac / 2;
    const OneThirdZodiac = self::Zodiac / 3;
    const Spot = 5;
    const HalfSpot = self::Spot / 2;
    const SpotOfZodiac = self::Zodiac / self::Spot;
    const Zero = 0;
    const Round = 360;
    const HalfRound = 180;
    const RangeIgnoreSEPOF = 330;
}

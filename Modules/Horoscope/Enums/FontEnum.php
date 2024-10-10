<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;
use Modules\Horoscope\Enums\WheelRadiusEnum;

final class FontEnum extends Enum
{
    const FontFolder = '/font/';
    # define font name of zodiac
    const Zodiac = self::FontFolder . 'zodiac.s.TTF';
    const ZodiacSize = 24 * WheelRadiusEnum::WheelScale;
    # define font name of zodiac
    const House = self::FontFolder . 'NotoSansJP-Medium.otf';
    const HouseSize = 18 * WheelRadiusEnum::WheelScale;
    const Planet = self::FontFolder . 'AstroDotBasic.ttf';
    const PlanetSize = 26 * WheelRadiusEnum::WheelScale;
    # define font name of zodiac
}

<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class DrawConfigEnum extends Enum
{
    # define for wheel drawing

    const FontFolder = '/font/';

    const BackgroundColorKey = 'background_color';
    const BorderKey = 'border';
    const FontKey = 'font';
    const FontSizeKey = 'font_size';
    const RadianKey = 'radian';

    const Aura = [
        self::BackgroundColorKey => WheelColorEnum::Aura,
        self::BorderKey => false,
        self::FontKey => '',
        self::FontSizeKey => '',
        self::RadianKey => WheelRadiusEnum::Aura,
    ];

    const Outer = [
        self::BackgroundColorKey => WheelColorEnum::Cream,
        self::BorderKey => true,
        self::FontKey => '',
        self::FontSizeKey => '',
        self::RadianKey => WheelRadiusEnum::Outer,
    ];

    const Inner = [
        self::BackgroundColorKey => WheelColorEnum::Cream,
        self::BorderKey => true,
        self::FontKey => '',
        self::FontSizeKey => '',
        self::RadianKey => WheelRadiusEnum::Inner,
    ];

    const Zodiac = [
        self::BackgroundColorKey => WheelColorEnum::Cream,
        self::BorderKey => true,
        self::FontKey => self::FontFolder . 'zodiac.s.ttf',
        self::FontSizeKey => 24 * WheelRadiusEnum::WheelScale,
        self::RadianKey => WheelRadiusEnum::Zodiac,
    ];

    const OuterMain = [
        self::BackgroundColorKey => WheelColorEnum::Aura,
        self::BorderKey => true,
        self::FontKey => '',
        self::FontSizeKey => '',
        self::RadianKey => WheelRadiusEnum::OuterMain,
    ];

    const Main = [
        self::BackgroundColorKey => WheelColorEnum::Cream,
        self::BorderKey => true,
        self::FontKey => self::FontFolder . 'HandyGeorge.ttf',
        self::FontSizeKey => 18 * WheelRadiusEnum::WheelScale,
        self::RadianKey => WheelRadiusEnum::Main,
    ];

    const InnerMain = [
        self::BackgroundColorKey => WheelColorEnum::Cream,
        self::BorderKey => true,
        self::FontKey => '',
        self::FontSizeKey => '',
        self::RadianKey => WheelRadiusEnum::InnerMain,
    ];
}

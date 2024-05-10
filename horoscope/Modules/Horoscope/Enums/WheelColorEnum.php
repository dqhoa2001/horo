<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class WheelColorEnum extends Enum
{
    // define color
    //const Background = '#f7f8f9';
    const Background = 'rgba(0, 0, 0, 0)';
    const Line = '#C6C7D1';
    const LineFamily = '#C7C8D1';
    const House = '#A9A9B8';
    const HouseFamily = '#ffffff';
    const WhiteLine = 'rgb(255,255,255)';
    const Blue = '#0000ff';
    const Red = '#ff0000';
    const Planet = '#39375E';
    const PlanetFamily = '#ffffff';
    const Aura = '#ebecee';
    const AuraFamily = '#ffffff1a';
    const Cream = '#f4f5f7';
    const CreamBg = '#ffffff4d';
    const Fire = '#ff0000';
    const Earth = '#66cdaa';
    // const Earth = '#00ff82';
    const Wind = '#ffae00';
    const Water = '#0041ff';
    const SabianTableContent = 'rgb(217,217,217)';

    // define zodiac element
    # Fire: 'Aries', 'Leo', 'Sagittarius'
    # Earth: 'Taurus', 'Virgo', 'Capricorn'
    # Wind: 'Gemini', 'Libra', 'Aquarius'
    # Water: 'Cancer', 'Scorpio', 'Pisces'
    const ZodiacElement = [
        self::Fire,  # Aries
        self::Earth, # Taurus
        self::Wind,  # Gemini
        self::Water, # Cancer
        self::Fire,  # Leo
        self::Earth, # Virgo
        self::Wind,  # Libra
        self::Water, # Scorpio
        self::Fire,  # Sagittarius
        self::Earth, # Capricorn
        self::Wind,  # Aquarius
        self::Water, # Pisces
    ];
}

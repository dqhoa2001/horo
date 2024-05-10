<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class SwephEnum extends Enum
{
    const PlanetIndexFrom = 0;
    const AscendantIndex = 15;
    const AscendantLength = 1;
    const PlanetLength = 13;
    const HouseLength = 12;

    const Sun = 0;
    const Moon = 1;
    const MERCURY = 2;
    const VENUS = 3;
    const MARS = 4;
    const JUPITER = 5;
    const SATURN  = 6;
    const URANUS = 7;
    const NEPTUNE = 8;
    const PLUTO = 9;
    const CHIRON = 10;
    const LILITH = 11;
    const TNODE = 12;
    const POF = 13;
    const VERTEX = 14;
    const LASTPLANET = 12;

    const SwephPath = '/sweph/ephe';
    const System = 'P';
}

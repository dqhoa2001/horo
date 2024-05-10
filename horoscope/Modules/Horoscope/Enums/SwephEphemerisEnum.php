<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;

final class SwephEphemerisEnum extends Enum
{
    const EphePath = '/sweph/ephe';
    const System = 'P';

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
    const ASC = 15;

    const House1 = self::ASC;
    const House2 = self::ASC + 1;
    const House3 = self::ASC + 2;
    const House4 = self::ASC + 3;
    const House5 = self::ASC + 4;
    const House6 = self::ASC + 5;
    const House7 = self::ASC + 6;
    const House8 = self::ASC + 7;
    const House9 = self::ASC + 8;
    const House10 = self::ASC + 9;
    const House11 = self::ASC + 10;
    const House12 = self::ASC + 11;
}

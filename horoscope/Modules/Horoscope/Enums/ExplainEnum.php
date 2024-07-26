<?php

namespace Modules\Horoscope\Enums;

use BenSampo\Enum\Enum;
final class ExplainEnum extends Enum
{
    const removePlanet = ['URANUS', 'NEPTUNE', 'PLUTO', 'LILITH', 'TNODE'];
    const removePlanetSolar = ['LILITH', 'TNODE','CHIRON'];

    const sortPlanet = ["MOON", "MERCURY", "VENUS", "SUN", "MARS", "JUPITER", "SATURN", "URANUS", "NEPTUNE", "PLUTO", "CHIRON", "LILITH", "TNODE"];
    const sortPlanetSolar = ["SUN", "MOON", "MERCURY", "VENUS", "MARS", "JUPITER", "SATURN", "URANUS", "NEPTUNE", "PLUTO", "CHIRON", "LILITH", "TNODE"];
}

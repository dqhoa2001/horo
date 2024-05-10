<?php

namespace Modules\Horoscope\Http\Actions\Predict;

use App\Models\Planet;
use App\Repositories\PlanetRepository;
use Illuminate\Support\Collection;
use Modules\Horoscope\Http\Actions\Convert\ConvertDecimalToDegrees;
use Modules\Horoscope\Http\Actions\Explain\GetAspectPattern;
use Modules\Horoscope\Http\Actions\Explain\GetHousePatternByPlanet;
use Modules\Horoscope\Http\Actions\Explain\GetSabianPatternByPlanet;
use Modules\Horoscope\Http\Actions\Explain\GetZodiacPatternByPlanet;

class GetExplainData
{

    /**
     * @param ConvertDecimalToDegrees $convertDecimalToDegrees
     * @param GetSabianPatternByPlanet $getSabianPatternByPlanet
     * @param GetHousePatternByPlanet $getHousePatternByPlanet
     * @param GetZodiacPatternByPlanet $getZodiacPatternByPlanet
     * @param GetAspectPattern $getAspectPattern
     */
    function __construct(
        protected ConvertDecimalToDegrees $convertDecimalToDegrees,
        protected GetSabianPatternByPlanet $getSabianPatternByPlanet,
        protected GetHousePatternByPlanet $getHousePatternByPlanet,
        protected GetZodiacPatternByPlanet $getZodiacPatternByPlanet,
        protected GetAspectPattern $getAspectPattern,
    ) {
    }

    /**
     * get explain from sweph degrees data
     *
     * @return Collection
     */
    function execute(Collection $degreesData): Collection
    {
        $patternContent = new Collection();
        // dd($degreesData->get('planets'));
        foreach ($degreesData->get('planets') as $planet) {
            $sabianDegrees = intval(ceil($planet->get('sabian_degrees')));
            $planetNum = $planet->get('planet_num');
            $zodiacNum = $planet->get('zodiac_num');
            $houseNum = $planet->get('house_num');
            $aspectPattern = new Collection();
            $zodiacPattern = $this->getZodiacPatternByPlanet
                ->execute($zodiacNum, $planetNum);
            $housePattern = $this->getHousePatternByPlanet
                ->execute($houseNum, $planetNum);
            $sabianPattern = $this->getSabianPatternByPlanet->execute($zodiacNum, $sabianDegrees);
            if ($planet->has('aspects')) {
                foreach ($planet->get('aspects') as $toPlanet) {
                    $toPlanetNum = $toPlanet->get('planet_num');
                    switch ($toPlanet->get('case')) {
                        case 0:
                            $case = 1;
                            break;
                        case 180:
                            $case = 2;
                            break;
                        case 90:
                            $case = 3;
                            break;
                        case 120:
                            $case = 4;
                            break;
                        case 60:
                            $case = 5;
                            break;
                        case 30:
                            $case = 6;
                            break;
                        case 150:
                            $case = 7;
                            break;
                        default:
                            # code...
                            break;
                    }
                    $pattern = $this->getAspectPattern->execute($planetNum, $toPlanetNum, $case);
                    $aspectPattern->push($pattern);
                }
            }
            $patternContent->put($planet->get('name'), collect([
                'planet' => Planet::find($planetNum),
                'zodiac_pattern' => $zodiacPattern,
                'house_pattern' => $housePattern,
                'sabian_pattern' => $sabianPattern,
                'aspect_pattern' => $aspectPattern,
            ]));
        }
        return $patternContent;
    }
}

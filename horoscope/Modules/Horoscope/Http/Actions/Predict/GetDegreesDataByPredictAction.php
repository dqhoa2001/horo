<?php

namespace Modules\Horoscope\Http\Actions\Predict;

use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Horoscope\Enums\AngleEnum;
use Modules\Horoscope\Enums\HouseEnum;
use Modules\Horoscope\Enums\PlanetGlyph;
use Modules\Horoscope\Enums\PlanetIndex;
use Modules\Horoscope\Enums\SwephEnum;
use Modules\Horoscope\Http\Actions\CalculateDegree\FindLineDegrees;
use Modules\Horoscope\Http\Actions\CalculateDegree\FindZodiacGlyphDegrees;
use Modules\Horoscope\Http\Actions\CalculateDegree\Aspect\FindAspecLine;
use Modules\Horoscope\Http\Actions\CalculateDegree\House\FindHouseAngle;
use Modules\Horoscope\Http\Actions\CalculateDegree\House\FindHouseGlyphDegree;
use Modules\Horoscope\Http\Actions\CalculateDegree\House\FindHouseLineDegree;
use Modules\Horoscope\Http\Actions\CalculateDegree\Planet\FindPlanetSpotDegrees;
use Modules\Horoscope\Http\Actions\CalculateDegree\Planet\FindPlanetGlyphDegrees;
use Modules\Horoscope\Http\Actions\CalculateDegree\Planet\FindPlanetLineDegrees;
use Modules\Horoscope\Http\Actions\Convert\AddPositionByDegreesAction;
use Modules\Horoscope\Http\Actions\Convert\ConvertDecimalToDegrees;

class GetDegreesDataByPredictAction
{
    /**
     * @param AddPositionByDegreesAction $addPositionByDegreesAction
     * @param FindLineDegrees $findLineDegrees
     * @param FindZodiacGlyphDegrees $findZodiacGlyphDegrees
     * @param FindPlanetSpotDegrees $findPlanetSpotDegrees
     * @param FindPlanetGlyphDegrees $findPlanetGlyphDegrees
     * @param FindPlanetLineDegrees $findPlanetLineDegrees
     * @param FindHouseAngle $findHouseAngle
     * @param FindHouseLineDegree $findHouseLineDegree
     * @param FindAspecLine $findAspecLine
     */
    function __construct(
        protected AddPositionByDegreesAction $addPositionByDegreesAction,
        protected FindLineDegrees $findLineDegrees,
        protected FindZodiacGlyphDegrees $findZodiacGlyphDegrees,
        protected FindPlanetSpotDegrees $findPlanetSpotDegrees,
        protected FindPlanetGlyphDegrees $findPlanetGlyphDegrees,
        protected FindPlanetLineDegrees $findPlanetLineDegrees,
        protected FindHouseAngle $findHouseAngle,
        protected FindHouseLineDegree $findHouseLineDegree,
        protected FindHouseGlyphDegree $findHouseGlyphDegree,
        protected FindAspecLine $findAspecLine,
        protected ConvertDecimalToDegrees $convertDecimalToDegrees,
    ) {
    }

    /**
     * get planet, house, ascendant from array predict data
     *
     * @param array $predictData
     * @param float $scale
     * @param bool $useBg
     * @return Collection
     */
    function execute(array $predictData, float $scale, bool $useBg): Collection
    {
        $degreeData = new Collection();
        #------------ASCENDANT-START--------------------------
        $ascendant = Arr::first(
            collect($predictData)
                ->splice(
                    SwephEnum::AscendantIndex,
                    SwephEnum::AscendantLength
                )
                ->first()
        );

        $ascendant = (Str::of($ascendant)->trim()->toFloat());
        #------------ASCENDANT-END----------------------------

        #------------PLANETS-START----------------------------
        $planetList = collect($predictData)
            ->splice(
                SwephEnum::PlanetIndexFrom,
                SwephEnum::PlanetLength
            )->values();

        $planets = new Collection();
        # 1 - modify degrees of planet from sweph
        foreach ($planetList as $key => $row) {
            $degrees = Str::of(Arr::first($row))->trim()->toFloat();
            $house = floor(Str::of(Arr::last($row))->trim()->toFloat());
            $zodiacNum = floor($degrees / AngleEnum::Zodiac);
            $sabianDegrees = $degrees - ($zodiacNum * AngleEnum::Zodiac);
            $planet = collect([
                'degrees' => $degrees,
                'sabian_degrees' => $sabianDegrees,
                'sabian_degrees_dms' => $this->convertDecimalToDegrees->execute($sabianDegrees),
                'name' => PlanetIndex::getKey($key),
                'annotation' => PlanetGlyph::getKey($key),
                'planet_num' => intval($key + 1),
                'zodiac_num' => intval($zodiacNum + 1),
                'house_num' => intval($house),
            ]);
            $planets->push($planet);
        }
        # 2 - put spot degrees of planet after sort asc
        $this->findPlanetSpotDegrees->execute($planets);
        # 3 - put degrees of planet glyph
        $planetGlyph = $this->findPlanetGlyphDegrees->execute($ascendant, $planets, $scale, $useBg);
        # 4 - put degrees of planet line
        $planetLine = $this->findPlanetLineDegrees->execute($ascendant, $planets);
        #------------PLANETS-END--------------------------------

        #------------HOUSE-START--------------------------------
        # degrees of houses
        $houseList = collect($predictData)
            ->splice(
                SwephEnum::AscendantIndex,
                SwephEnum::HouseLength
            )
            ->values();
        $houses = new Collection();
        # 1 - modify degree of house from sweph
        foreach ($houseList as $key => $row) {
            $degrees = (Str::of(Arr::first($row))->trim()->toFloat());
            $zodiacNum = floor($degrees / AngleEnum::Zodiac);
            $sabianDegrees = $degrees - ($zodiacNum * AngleEnum::Zodiac);
            $house = collect([
                'degrees' => $degrees,
                'sabian_degrees' => $sabianDegrees,
                'sabian_degrees_dms' => $this->convertDecimalToDegrees->execute($sabianDegrees),
                'name' => HouseEnum::getKey($key),
                'number' => intval($key + 1),
                'zodiac_num' => intval($zodiacNum + 1),
            ]);
            $houses->push($house);
        }
        # 2 - put angle each house
        $this->findHouseAngle->execute($houses);
        # 3 - put degree of house line
        $houseLine = $this->findHouseLineDegree->execute($houses);
        # 4 - put degree of house glyph
        $houseGlyph = $this->findHouseGlyphDegree->execute($houseLine, $scale, $useBg);
        #------------HOUSE-END--------------------------------


        // @ADD 2024-1-8 by kaibetty
        // $planet.house_num と $house.degrees 間の齟齬を修正する.
        //  -> $house.degrees に揃えて$planet.house_numを更新。
        //
        //  Swiss Ephemeris は天体のハウス位置(house position)を
        //  算出する時、黄道と軌道のズレを加味して3次元空間の座標で計算する。
        //  swetest の -fj オプションで取得できる"house number"がこれに該当。
        //
        //  しかし、本ホロスコープの描画は、占星術の伝統的な手法に倣い、
        //  各天体が黄道上にあると仮定して、1次元の度数で位置を表現。
        //
        //  このため、ハウスの番号("house number")と、ハウスの度数表に
        //  矛盾があるように見えることが起こることが分かった。
        //
        //  ここでは、従来の方法との整合を保つため、
        //  天体のハウス番号("house number")を、ハウスの度数表に照らして
        //  決定し、上書きする。
        //
        //
        #------------PLANET'S HOUSE NUM-START-----------------
        $houseSorted = $houses->sortByDesc('degrees');
        foreach ($planets as $key => $planet) {
            foreach ($houseSorted as $hidx => $house) {
                if ( $planet->get('degrees') >= $house->get('degrees')) {
                    $planet->put('house_num', $house->get('number'));
                    break;
                }
            }
        }
        #------------PLANET'S HOUSE NUM-END-------------------

        #------------ASPECT-START--------------------------------
        # add aspect of planet to planets
        $aspectLine = $this->findAspecLine->execute($ascendant, $planets);

        #-----------LINE-ANNOTATION-OTHER-START----------------
        # current degree of ascendant
        # line 1/3 degree of zodiac (zodiac a angle has 30 degree)
        $oneThirdLine = $this->findLineDegrees->execute(
            $ascendant,
            AngleEnum::OneThirdZodiac
        );

        # line zodiac a angle has 30 degree
        $zodiacLine = $this->findLineDegrees->execute(
            $ascendant,
            AngleEnum::Zodiac
        );

        # zodiac glyph is center of zodiac degree so need to plush 1/2 of zodiac degree
        $zodiacGlyph = $this->findZodiacGlyphDegrees->execute($ascendant);

        #-----------LINE-ANNOTATION-OTHER-END----------------

        # add position by degrees
        $this->addPositionByDegreesAction->execute($oneThirdLine);
        $this->addPositionByDegreesAction->execute($zodiacLine);
        $this->addPositionByDegreesAction->execute($zodiacGlyph);

        $this->addPositionByDegreesAction->execute($planetGlyph->get('glyphs'));
        $this->addPositionByDegreesAction->execute($planetLine->get('from'));
        $this->addPositionByDegreesAction->execute($planetLine->get('to'));

        $this->addPositionByDegreesAction->execute($houseGlyph->get('glyphs'));
        $this->addPositionByDegreesAction->execute($houseLine);

        // dd($aspectLine);
        foreach ($aspectLine as $key => $line) {
            $this->addPositionByDegreesAction->execute($line->get('from'));
            $this->addPositionByDegreesAction->execute($line->get('to'));
        }

        # data below is had convert from degrees to radian
        $degreeData->put('ascendant', $ascendant);
        $degreeData->put('planets', $planets);
        $degreeData->put('houses', $houses);
        $degreeData->put('one_third_line', $oneThirdLine);
        $degreeData->put('zodiac_line', $zodiacLine);
        $degreeData->put('zodiac_glyph', $zodiacGlyph);
        $degreeData->put('planet_glyph', $planetGlyph);
        $degreeData->put('planet_line', $planetLine);
        $degreeData->put('house_glyph', $houseGlyph);
        $degreeData->put('house_line', $houseLine);
        $degreeData->put('aspect_line', $aspectLine);

        return $degreeData;
    }
}

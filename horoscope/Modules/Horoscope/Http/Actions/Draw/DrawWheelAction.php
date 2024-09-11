<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Imagick;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Modules\Horoscope\Enums\ZodiacElementEnum;
use Modules\Horoscope\Enums\ZodiacEnum;

class DrawWheelAction
{
    /**
     * @param DrawLineAction $drawLineAction
     * @param DrawHouseLineAction $drawHouseLineAction
     * @param DrawPlanetLineAction $drawPlanetLineAction
     * @param DrawAspectLineAction $drawAspectLineAction
     * @param DrawHouseGlyphAction $drawHouseGlyphAction
     * @param DrawZodiacGlyphAction $drawZodiacGlyphAction
     * @param DrawPlanetGlyphAction $drawPlanetGlyphAction
     */
    function __construct(
        protected DrawLineAction $drawLineAction,
        protected DrawHouseLineAction $drawHouseLineAction,
        protected DrawPlanetLineAction $drawPlanetLineAction,
        protected DrawAspectLineAction $drawAspectLineAction,
        protected DrawHouseGlyphAction $drawHouseGlyphAction,
        protected DrawZodiacGlyphAction $drawZodiacGlyphAction,
        protected DrawPlanetGlyphAction $drawPlanetGlyphAction,
    ) {
    }

    /**
     *
     *  get postion from degree data, add item to draw object
     *
     * @param Imagick $image
     * @param Collection $wheels
     * @param Collection $degreesData
     *
     */
    function execute(
        Imagick $image,
        Collection $wheels,
        Collection $degreesData,
        float $scale,
        bool $solar
    ): void {
        # draw line 10 degrees outer wheel
        $this->drawLineAction->execute(
            $wheels->get('outer'),
            $degreesData->get('one_third_line'),
            WheelRadiusEnum::Outer,
            $scale
        );

        # draw line 30 degrees zodiac wheel
        $this->drawLineAction->execute(
            $wheels->get('zodiac'),
            $degreesData->get('zodiac_line'),
            WheelRadiusEnum::Zodiac,
            $scale
        );

        # draw line 10 degrees inner wheel
        $this->drawLineAction->execute(
            $wheels->get('inner'),
            $degreesData->get('one_third_line'),
            WheelRadiusEnum::Inner,
            $scale
        );


        # draw zodiac glyph to zodiac wheel
        $zodiacName = ZodiacEnum::getKeys();
        foreach ($degreesData->get('zodiac_glyph') as $key => $zodiacGlyph) {
            $name = $zodiacName[$key];
            $element = ZodiacElementEnum::getValue($name);
            $zodiacGlyph->put('name', $name);
            $zodiacGlyph->put('annotation', ZodiacEnum::getValue($name));
            $zodiacGlyph->put('font_name', resource_path() . FontEnum::Zodiac);
            $zodiacGlyph->put('font_size', FontEnum::ZodiacSize * $scale);
            $zodiacGlyph->put('color', WheelColorEnum::getValue($element));
            $zodiacGlyph->put('fill_color', WheelColorEnum::getValue($element));
        }

        $this->drawZodiacGlyphAction->execute(
            $wheels->get('zodiac'),
            $degreesData->get('zodiac_glyph'),
            WheelRadiusEnum::ZodiacGlyph,
            $scale
        );

        # draw house line to main
        $this->drawHouseLineAction->execute(
            $wheels->get('main'),
            $degreesData->get('house_line'),
            WheelRadiusEnum::OuterMain,
            $scale
        );
        # draw house glyph to main
        $this->drawHouseGlyphAction->execute(
            $image,
            $wheels->get('main'),
            $degreesData->get('house_glyph'),
            WheelRadiusEnum::HouseGlyph,
            $scale
        );

        # draw planet glyph to outer main wheel
        # add annotation
        $this->drawPlanetGlyphAction->execute(
            $wheels->get('outer_main'),
            $degreesData->get('planet_glyph'),
            WheelRadiusEnum::PlanetGlyph,
            $scale
        );
        $this->drawAspectLineAction->execute(
            $wheels->get('main'),
            $degreesData->get('aspect_line'),
            WheelRadiusEnum::Main,
            $scale
        );

        # add planet line
        $this->drawPlanetLineAction->execute(
            $wheels->get('outer_main'),
            $degreesData->get('planet_line'),
            $scale,
            $solar
        );
        foreach ($wheels as $key => $wheel) {
            $image->drawImage($wheel);
        }
    }
}

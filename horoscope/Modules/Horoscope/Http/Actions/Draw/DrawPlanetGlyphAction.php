<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use ImagickDraw;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class DrawPlanetGlyphAction
{
    /**
     * add annotation to draw object
     *
     * @param ImagickDraw $draw
     * @param Collection $glyphs
     * @param float $radius
     * @return void
     */
    function execute(
        ImagickDraw $draw,
        Collection $planetGlyphs,
        float $radius,
        float $scale
    ): void {
        $draw->setFont($planetGlyphs->get('font_name') ?? resource_path() . FontEnum::Zodiac);
        $draw->setFontSize($planetGlyphs->get('font_size') ?? FontEnum::ZodiacSize * $scale);
        $draw->setStrokeColor($planetGlyphs->get('color') ?? WheelColorEnum::Line);
        $draw->setFillColor($planetGlyphs->get('fill_color') ?? WheelColorEnum::Line);
        $draw->setStrokeOpacity(0);
        $centerX = (-16 / 2) * (WheelRadiusEnum::WheelScale * $scale);
        $centerY = (16 / 2) * (WheelRadiusEnum::WheelScale * $scale);
        $gapGlyph = (-10) * (WheelRadiusEnum::WheelScale * $scale);
        $glyphs = $planetGlyphs->get('glyphs');

        foreach ($glyphs as $glyph) {
            $offsetX = $centerX * $glyph->get('radian_x');
            $offsetY = $centerY * $glyph->get('radian_y');
            $x = ((- ($radius * $scale) + $gapGlyph) * $glyph->get('radian_x')) + $centerX + $offsetX;
            $y = ((($radius * $scale) - $gapGlyph) * $glyph->get('radian_y')) + $centerY + $offsetY;

            $annotation = $glyph->get('annotation');

            $draw->annotation(
                $x + (WheelRadiusEnum::WheelCenter * $scale),
                $y + (WheelRadiusEnum::WheelCenter * $scale),
                $annotation
            );
        }
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Imagick;
use ImagickDraw;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class DrawHouseGlyphAction
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
        Imagick $image,
        ImagickDraw $draw,
        Collection $houseGlyphs,
        float $radius,
        float $scale
    ): void {
        $draw->setFont($houseGlyphs->get('font_name') ?? resource_path() . FontEnum::House);
        $draw->setFontSize($houseGlyphs->get('font_size') ?? (FontEnum::HouseSize * $scale));
        $draw->setStrokeColor($houseGlyphs->get('color') ?? WheelColorEnum::Line);
        $draw->setFillColor($houseGlyphs->get('color') ?? WheelColorEnum::Line);
        $draw->setStrokeOpacity(0);
        $glyphs = $houseGlyphs->get('glyphs');
        foreach ($glyphs as $glyph) {
            $x = - ($radius * $scale) * $glyph->get('radian_x');
            $y = ($radius * $scale) * $glyph->get('radian_y');

            $annotation = $glyph->get('annotation');

            $charactersMetrics = $image->queryFontMetrics($draw, $glyph);
            $offsetX = ($charactersMetrics['characterWidth'] / ($annotation < 10 ? 3.5 : 1.5));
            $offsetY = $charactersMetrics['characterHeight'] / ($annotation < 7 ? 2 : 1.8) +
                $charactersMetrics['descender'];
            $draw->annotation(
                $x + (WheelRadiusEnum::WheelCenter * $scale) - $offsetX,
                $y + (WheelRadiusEnum::WheelCenter * $scale) + $offsetY,
                $annotation
            );
        }
    }
}

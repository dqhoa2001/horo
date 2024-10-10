<?php

namespace Modules\Horoscope\Http\Actions\Draw;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use Imagick;
use ImagickDraw;
use Modules\Horoscope\Enums\FontEnum;
use Modules\Horoscope\Enums\WheelColorEnum;

class DrawZodiacGlyphAction
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
        Collection $glyphs,
        float $radius,
        float $scale,
    ): void {
        $centerX = (-22 / 2) * (WheelRadiusEnum::WheelScale * $scale);
        $centerY = (20 / 2) * (WheelRadiusEnum::WheelScale * $scale);
        $gapGlyph = (-14) * (WheelRadiusEnum::WheelScale * $scale);

        foreach ($glyphs as $glyph) {
            $offsetX = $centerX * $glyph->get('radian_x');
            $offsetY = $centerY * $glyph->get('radian_y');
            $x = ((- ($radius * $scale) + $gapGlyph) * $glyph->get('radian_x')) + $centerX + $offsetX;
            $y = ((($radius * $scale) - $gapGlyph) * $glyph->get('radian_y')) + $centerY + $offsetY;

            $annotation = $glyph->get('annotation');
            $draw->setFont($glyph->get('font_name') ?? resource_path() . FontEnum::Zodiac);
            $draw->setFontSize($glyph->get('font_size') ?? (FontEnum::ZodiacSize * $scale));
            $draw->setStrokeColor($glyph->get('color') ?? WheelColorEnum::Line);
            $draw->setFillColor($glyph->get('fill_color') ?? WheelColorEnum::Line);
            $draw->setStrokeOpacity(0);
            $draw->annotation(
                $x + (WheelRadiusEnum::WheelCenter * $scale),
                $y + (WheelRadiusEnum::WheelCenter * $scale),
                $annotation
            );
            $draw->setStrokeOpacity(0);
        }
    }
}

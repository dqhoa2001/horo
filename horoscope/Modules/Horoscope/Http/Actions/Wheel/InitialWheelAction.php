<?php

namespace Modules\Horoscope\Http\Actions\Wheel;

use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\AngleEnum;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;
use ImagickDraw;
use ImagickPixel;
use Modules\Horoscope\Enums\DrawConfigEnum;
use Modules\Horoscope\Enums\WheelNameEnum;

class InitialWheelAction
{
    /**
     * generate horoscope chart has multi wheel
     * @return Collection
     */
    function execute($wheelList)
    {
        $wheels = [];
        foreach ($wheelList as $wheel) {
            $draw = $this->createWheel($wheel);
            // # add item if need here
            if ($wheel->has('lines') && !empty($wheel->get('lines'))) {
                $this->addLineToDrawObject($draw, $wheel->get('lines'));
            }

            if ($wheel->has('glyphs') && !empty($wheel->get('glyphs'))) {
                $this->addGlyphToDrawObject($draw, $wheel->get('glyphs'));
            }

            // # end
            $wheels[] = $draw;
        }

        return $wheels;
    }

    /**
     *  new eclipse object draw
     *
     * @param float $radius
     * @param string $fillColor
     * @param bool $border
     * @return Collection
     */
    private function createWheel(Collection $config): ImagickDraw
    {
        // new wheel draw object
        $draw = new ImagickDraw();
        $draw->setFillColor(new ImagickPixel($config->get(DrawConfigEnum::BackgroundColorKey)));
        if ($config->get('border')) {
            $draw->setStrokeColor(new ImagickPixel(WheelColorEnum::Line));
        }
        // add ellipse to wheel object
        $draw->ellipse(
            WheelRadiusEnum::WheelCenter,
            WheelRadiusEnum::WheelCenter,
            $config->get(DrawConfigEnum::RadianKey),
            $config->get(DrawConfigEnum::RadianKey),
            AngleEnum::Zero,
            AngleEnum::Round
        );
        return $draw;
    }

    private function addGlyphToDrawObject($draw, $glyphs)
    {
        # set font
        $draw->setFont(resource_path() . $glyphs->get('font'));
        $draw->setFontSize($glyphs->get('size'));
        $draw->setStrokeColor(new ImagickPixel($glyphs->get('color')));
        $draw->setFillColor(new ImagickPixel($glyphs->get('color')));
        # draw
        foreach ($glyphs->get('positions') as $glyph) {
            $draw->annotation(
                $glyph['x'],
                $glyph['y'],
                $glyph['content']
            );
        }
    }

    private function addLineToDrawObject($draw, $lines)
    {
        if ($lines->has('color') && !empty($lines->get('color'))) {
            $draw->setStrokeColor(new ImagickPixel($lines->get('color')));
        }

        if ($lines->has('positions') && !empty($lines->get('positions'))) {
            foreach ($lines->get('positions') as $line) {
                $draw->line(
                    $line['from_x'],
                    $line['from_y'],
                    $line['to_x'],
                    $line['to_y']
                );
            }
        }
    }
}

<?php

namespace Modules\Horoscope\Http\Actions\Chart;

use Modules\Horoscope\Http\Actions\Chart\GenerateWheelAction;
use Illuminate\Support\Collection;
use Modules\Horoscope\Enums\WheelColorEnum;
use Modules\Horoscope\Enums\WheelRadiusEnum;

class GetListWheelAction
{
    /**
     * @param GenerateWheelAction $generateWheelAction
     */
    function __construct(
        protected GenerateWheelAction $generateWheelAction
    ) {
    }

    function execute(float $scale, bool $useBackground)
    {
        $wheels = new Collection();
        $auraWheelColor = $useBackground ? WheelColorEnum::AuraFamily : WheelColorEnum::Aura;
        $outerMainWheelColor = $useBackground ? WheelColorEnum::AuraFamily : WheelColorEnum::Aura;
        $Cream = $useBackground ? WheelColorEnum::CreamBg : WheelColorEnum::Cream;
        $auraWheel = $this->generateWheelAction->execute(
            $scale,
            WheelRadiusEnum::Aura,
            $auraWheelColor,
            false,
            false
        );
        $zodiacWheel = $this->generateWheelAction->execute(
            $scale,
            WheelRadiusEnum::Zodiac,
            $Cream,
            true,
            false
        );
        if($useBackground){
            $outerWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Outer,
                $Cream,
                false,
                true
            );
            $innerWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Inner,
                $Cream,
                false,
                true
            );
            $mainWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Main,
                $Cream,
                true,
                false
            );
            $innerMainWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::InnerMain,
                $Cream,
                true,
                false
            );
        }
        else{
            $outerWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Outer,
                $Cream,
                true,
                $useBackground
            );
            $innerWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Inner,
                $Cream,
                true,
                $useBackground
            );
            $mainWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::Main,
                $Cream,
                true,
                $useBackground
            );
            $innerMainWheel = $this->generateWheelAction->execute(
                $scale,
                WheelRadiusEnum::InnerMain,
                $Cream,
                true,
                $useBackground
            );
        }

        $outerMainWheel = $this->generateWheelAction->execute(
            $scale,
            WheelRadiusEnum::OuterMain,
            $outerMainWheelColor,
            true,
            $useBackground
        );

        $wheels->put('aura', $auraWheel);
        $wheels->put('outer', $outerWheel);
        $wheels->put('zodiac', $zodiacWheel);
        $wheels->put('inner', $innerWheel);
        $wheels->put('outer_main', $outerMainWheel);
        $wheels->put('main', $mainWheel);
        $wheels->put('inner_main', $innerMainWheel);

        return $wheels;
    }
}

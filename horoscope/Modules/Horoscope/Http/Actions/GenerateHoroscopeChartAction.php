<?php

namespace Modules\Horoscope\Http\Actions;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Horoscope\Http\Actions\Chart\GenerateImageAction;
use Modules\Horoscope\Http\Actions\Chart\GetListWheelAction;
use Modules\Horoscope\Http\Actions\Draw\DrawWheelAction;
use Modules\Horoscope\Http\Actions\Predict\GetDegreesDataByPredictAction;
use Modules\Horoscope\Http\Actions\Predict\GetExplainData;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\Predict\PredictDayOfBirthAction;
use Imagick;

class GenerateHoroscopeChartAction
{
    /**
     * @param GenerateImageAction $generateImageAction
     * @param GetListWheelAction $getListWheelAction
     * @param PredictDayOfBirthAction $predictDayOfBirthAction
     * @param GetDegreesDataByPredictAction $getDegreesDataByPredictAction
     * @param DrawWheelAction $drawWheelAction
     * @param ModifyLocation $modifyLocation
     * @param GetExplainData $getExplainData
     *
     */
    function __construct(
        protected GenerateImageAction $generateImageAction,
        protected GetListWheelAction $getListWheelAction,
        protected PredictDayOfBirthAction $predictDayOfBirthAction,
        protected GetDegreesDataByPredictAction $getDegreesDataByPredictAction,
        protected DrawWheelAction $drawWheelAction,
        protected ModifyLocation $modifyLocation,
        protected GetExplainData $getExplainData,
    ) {
    }

    function execute(array $request, float $scale = 1): Collection
    {
        # modify request data
        $date = Carbon::create(
            $request['year'],
            $request['month'],
            $request['day'],
            $request['hour'],
            $request['minute']
        );
        $useBg = $request['background'] != 'normal' ? true : false;
        if ($request['timezone'] > 0) {
            $date->subMinutes(60 * $request['timezone']);
        } else {
            $date->addMinutes(60 * abs($request['timezone']));
        }
        $localtion = $this->modifyLocation->execute($request['longitude'], $request['latitude']);
        # init image object
        $randomBG = rand(1, 5);
        $bgPath = $useBg
            ? module_path('horoscope', 'Resources/assets/images/' . $randomBG . '.png')
            : "";
        $image = $this->generateImageAction->execute($scale);
        $wheels = $this->getListWheelAction->execute($scale, $useBg);
        # get data from request
        $swephData = $this->predictDayOfBirthAction->execute(
            $date->format('d.m.Y'),
            $date->format('H:i'),
            $localtion->get('longitude'),
            $localtion->get('latitude')
        );
        if (empty($swephData)) {
            return collect([
                'status' => false
            ]);
        }
        # degree data about ascendant, planet: Sun ~ Vertex, house: 1 ~ 12
        $degreeData = $this->getDegreesDataByPredictAction->execute($swephData, $scale, $useBg);
        $explainData = $this->getExplainData->execute($degreeData);
        # draw to wheels
        $this->drawWheelAction->execute($image, $wheels, $degreeData, $scale);
        // dd($bgPath);
        if (!empty($bgPath)) {
            $imageBack = new Imagick();
            $imageBack->readImage($bgPath);
            // $imageCopied = clone $image;
            // $imageCopied->compositeImage($imageBack, Imagick::COMPOSITE_IN, 0, 0, Imagick::CHANNEL_DEFAULT);
            $image->compositeImage($imageBack, Imagick::COMPOSITE_BLEND, 0, 0, Imagick::CHANNEL_DEFAULT);
        }
        return collect([
            'status' => true,
            'image' => $image,
            'degreeData' => $degreeData,
            'explain' => $explainData
        ]);
    }
}

<?php

namespace Modules\Horoscope\Http\Actions;

use App\Models\AppraisalApply;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\Horoscope\Http\Actions\Chart\GenerateImageAction;
use Modules\Horoscope\Http\Actions\Chart\GetListWheelAction;
use Modules\Horoscope\Http\Actions\Draw\DrawWheelAction;
use Modules\Horoscope\Http\Actions\Predict\GetDegreesDataByPredictAction;
use Modules\Horoscope\Http\Actions\Predict\GetExplainData;
use Modules\Horoscope\Http\Actions\Predict\ModifyLocation;
use Modules\Horoscope\Http\Actions\Predict\PredictDayOfBirthAction;
use Imagick;
use Modules\Horoscope\Enums\SwephEnum;
use Illuminate\Support\Str;
use Modules\Horoscope\Enums\AngleEnum;

class GenerateSolarHoroscopeChartAction
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

    public function execute(array $request, float $scale = 1): Collection
    {
        #solar_return_year
        $solarYear = $request['solar_year'];
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
        $swephData = $this->findDayOfBirthSolar($date, $localtion,$solarYear);
        if (empty($swephData)) {
            return collect([
                'status' => false
            ]);
        }
        # degree data about ascendant, planet: Sun ~ Vertex, house: 1 ~ 12
        $degreeData = $this->getDegreesDataByPredictAction->execute($swephData, $scale, $useBg);
        $explainData = $this->getExplainData->execute($degreeData);
        // dd($explainData);
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
            'explain' => $explainData,
        ]);
    }

    private function findDayOfBirthSolar(Carbon $date, Collection $localtion, Int $solar_year): array
    {
        // day of birth
        $swephData = $this->predictDayOfBirthAction->execute(
            $date->format('d.m.Y'),
            $date->format('H:i'),
            $localtion->get('longitude'),
            $localtion->get('latitude')
        );
        $dayOfBirthDegrees = $this->calculateSolarDegrees($swephData);
        // day of birth solar
        $solarDate = Carbon::create($solar_year, $date->month, $date->day, $date->hour, $date->minute)->subDays(3);
        $counter = 0;
        $dayOfBirthSolarDegrees = 0;
        do {
            if ($counter > 0) {
                $solarDate = $solarDate->addHour();
            }
            $swephSolarData = $this->predictDayOfBirthAction->execute(
                $solarDate->format('d.m.Y'),
                $solarDate->format('H:i'),
                $localtion->get('longitude'),
                $localtion->get('latitude')
            );
            $dayOfBirthSolarDegrees = $this->calculateSolarDegrees($swephSolarData);
            $counter++;
        } while ($dayOfBirthSolarDegrees !== $dayOfBirthDegrees);
        return $this->predictDayOfBirthAction->execute(
            $solarDate->format('d.m.Y'),
            $solarDate->format('H:i'),
            $localtion->get('longitude'),
            $localtion->get('latitude')
        );
    }

    private function calculateSolarDegrees(array $predictData): int
    {
        $planetList = collect($predictData)
            ->splice(
                SwephEnum::PlanetIndexFrom,
                SwephEnum::PlanetLength
            )->values();
        $planetRow = $planetList->first();
        $degrees = Str::of(Arr::first($planetRow))->trim()->toFloat();
        $zodiacNum = floor($degrees / AngleEnum::Zodiac);
        $sabianDegrees = (int) floor($degrees - ($zodiacNum * AngleEnum::Zodiac));
        return $sabianDegrees;
    }
}

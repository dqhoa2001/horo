<?php

namespace Modules\Horoscope\Http\Actions\Predict;

use Modules\Horoscope\Enums\SwephEphemerisEnum;

class PredictDayOfBirthAction
{
    /**
     * @param ModifyPredictData $modifyPredictData
     */
    function __construct(
        protected ModifyPredictData $modifyPredictData
    ) {
    }

    /**
     * execute program to get result predict by birth day and location
     *
     * @param string $date
     * @param string $time
     * @param float $longitude
     * @param float $latitude
     * @param bool $format
     * @return array
     */
    function execute(
        string $date,
        string $time,
        float $longitude,
        float $latitude,
        bool $format = true
    ): array {
        $swephPath = __DIR__ . SwephEphemerisEnum::EphePath;
        $system = SwephEphemerisEnum::System;
        exec("$swephPath/swetest -edir\"" . "/$swephPath\" -b$date -ut$time -p0123456789tDAtt -eswe -house$longitude,$latitude,$system -flsj -g, -head", $output);
        return $format
            ? $this->modifyPredictData->execute($output)
            : $output;
    }
}

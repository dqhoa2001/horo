<?php

namespace Modules\Horoscope\Http\Actions\Predict;

class ModifyPredictData
{
    function execute(array $predictResult)
    {
        $modifyData = [];
        foreach ($predictResult as $line) {
            $modifyData[] = explode(',', $line);
        }
        return $modifyData;
    }
}

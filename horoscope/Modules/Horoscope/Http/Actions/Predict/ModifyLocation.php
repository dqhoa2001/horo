<?php

namespace Modules\Horoscope\Http\Actions\Predict;

use Illuminate\Support\Collection;

class ModifyLocation
{
    /**
     * @param float $longitude
     * @param float $latitude
     * @return Collection
     */
    function execute(
        float $longitude,
        float $latitude
    ): Collection {
        $ew = ($longitude >= 0) ? 1 : -1;
        $ns = ($latitude >= 0) ? 1 : -1;
        // 経度
        $lng = $longitude;
        $tmplng = explode(".", $lng);
        if ($tmplng != false) {
            $long_deg = $tmplng[0];
            $long_min = $tmplng[1];
        }
        if (intval($long_deg) < 0) {
            $ew = -1;
            $long_deg = abs($long_deg);
        } else {
            $ew = 1;
        }

        if ($long_min) {
            $long_min = intval(substr($long_min, 0, 2) / 100 * 60);
        }
        // 緯度
        $lat = $latitude;
        $tmplat = explode(".", $lat);
        if ($tmplat != false) {
            $lat_deg = $tmplat[0];
            $lat_min = $tmplat[1];
        }
        if (intval($lat_deg) < 0) {
            $ns = -1;
            $lat_deg = abs($lat_deg);
        } else {
            $ns = 1;
        }

        if ($lat_min) {
            $lat_min = intval(substr($lat_min, 0, 2) / 100 * 60);
        }
        $my_longitude = $ew * ($long_deg + ($long_min / 60));
        $my_latitude = $ns * ($lat_deg + ($lat_min / 60));
        return collect([
            'longitude_degree' => $long_deg,
            'longitude_minute' => $long_min,
            'latitude_degree' => $lat_deg,
            'latitude_min' => $lat_min,
            'longitude' => $my_longitude,
            'latitude' => $my_latitude,
        ]);
    }
}

<?php

namespace App\Library;

use App\Enums\Todofuken;

class GetPrefNum
{
    //Geocoding APIを使用して住所から都道府県番号を取得する
    public static function getPrefNum(string $address): int
    {
        // google map apiで都道府県を取得
        $todofuken = '';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . config('app.google_map_api_key');
        $json = file_get_contents($url);
        $obj = json_decode($json, true);
        
        if ($obj['status'] === 'OK') {
            foreach ($obj['results'][0]['address_components'] as $addressComponent) {
                if (\in_array('administrative_area_level_1', $addressComponent['types'], true)) {
                    $todofuken = $addressComponent['long_name'];
                    break;
                }
            }
        }
        $prefNum = Todofuken::toInt()[$todofuken];

        return $prefNum;
    }
}

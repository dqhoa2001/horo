<?php

namespace App\Library;

class GetGeocoding
{
    //Geocoding APIを使用して住所から緯度経度を取得する
    public static function GetGeocodingData(string $address): array
    {
        $geocodingData = [];
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "+CA&key=" . config('app.google_map_api_key') ;
        $contents= file_get_contents($url);
        $jsonData = json_decode($contents,true);
        $geocodingData['longitude'] = $jsonData["results"][0]["geometry"]["location"]["lng"];
        $geocodingData['latitude'] = $jsonData["results"][0]["geometry"]["location"]["lat"];
        return $geocodingData;
    }
}

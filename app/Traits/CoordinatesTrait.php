<?php


namespace App\Traits;

trait CoordinatesTrait
{
    public function wgs84ToRelative(float $longitude, float $latitude): array
    {
        $east = ['lat' => 46.475583, 'lon' => 16.596907];
        $west = ['lat' => 46.297715, 'lon' => 13.375333];
        $south = ['lat' => 45.421480, 'lon' => 15.177411];
        $north = ['lat' => 46.876640, 'lon' => 16.233445];
        $relativeLongitude = ($longitude / $west['lon']) - 1;
        $relativeLatitude = ($latitude / $south['lat']) - 1;
        return [
            'lat' => $relativeLatitude,
            'lon' => $relativeLongitude
        ];
    }
}

<?php


namespace App\Services;


class ExportTransformService
{
    public static function toJson(array $result): string
    {

        return json_encode(array_map(function ($e) {
            $e = (array)$e;
            return [
                'id' => $e['id'],
                'title' => $e['title'],
                'description' => $e['description'],
                'dangerous' => (bool)$e['dangerous'],
                'cleared' => (bool)$e['cleared'],
                'urgent' => (bool)$e['urgent'],
                'area' => $e['area'],
                'distance' => $e['distance'],
                'estimated_volume' => $e['estimated_volume'],
                'volume' => $e['volume'],
                'access' => $e['access_type'],
                'terrain' => $e['terrains_type'],
                'irsop' => [
                    'name' => $e['irsop_name'],
                    'address' => $e['irsop_address'],
                    'email' => $e['irsop_email'],
                    'tel' => $e['irsops_tel']
                ],
                'geodetic_information' => [
                    'region_id' => $e['region_id'],
                    'region_name' => $e['region_name'],
                    'municipality_id' => $e['municipality_id'],
                    'municipality_name' => $e['municipality_name'],
                    'cadastral_municipality_id' => $e['cadastral_municipality_id'],
                    'cadastral_municipality_name' => $e['cadastral_municipality_name'],
                    'portion' => $e['portion'],
                ],
                'coordinates' => [
                    'wgs84_longitude' => $e['wgs84_longitude'],
                    'wgs84_latitude' => $e['wgs84_latitude']
                ],
                'trash_types' => [
                    'organic_waste' => $e['organic_waste'],
                    'construction_waste' => $e['construction_waste'],
                    'municipal_waste' => $e['municipal_waste'],
                    'bulk_waste' => $e['bulk_waste'],
                    'hazardous_waste' => $e['hazardous_waste'],
                    'tires' => $e['tires'],
                    'vehicles' => $e['vehicles'],
                    'asbestos_plates' => $e['asbestos_plates'],
                    'hazardous_liquids' => $e['hazardous_liquids'],
                ],
                'comments' => $e['comments']
            ];
        }, $result));
    }
}

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
                'estimated_volume' => $e['estimated_volume'],
                'volume' => $e['volume'],
                'access' => $e['access_type'],
                'terrain' => $e['terrains_type'],
                'state_inspectorate' => [
                    'name' => $e['state_inspectorate_name'],
                    'address' => $e['state_inspectorate_address'],
                    'email' => $e['state_inspectorate_email'],
                    'tel' => $e['state_inspectorate_tel']
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
                    'wgs84' => [
                        'longitude' => $e['wgs84_longitude'],
                        'latitude' => $e['wgs84_latitude']
                    ]
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

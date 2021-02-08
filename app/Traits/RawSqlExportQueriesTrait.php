<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/*
 * These queries ran extremely slow with eloquent, TODO: rewrite in eloquent for easier maintenance
 */

trait RawSqlExportQueriesTrait
{
    public function dumpsByRegionOrMunicipality($type = null, $id = null): array
    {
        $baseQuery = "SELECT
                        `dumps`.`id` as `id`,
                        `title`,
                        `description`,
                        `dangerous`,
                        `cleared`,
                        `distance`,
                        `urgent`,
                        `dumps`.`area` as `area`,
                        `irsops`.`name` as `irsop_name`,
                        `irsops`.`email` as `irsop_email`,
                        `irsops`.`address` as `irsop_address`,
                        `irsops`.`tel` as `irsops_tel`,
                        `terrains`.`type` as `terrains_type`,
                        `accesses`.`type` as `access_type`,
                        `volumes`.`amount` as `estimated_volume`,
                        `volumes`.`text` as `volume`,
                        `coordinates`.`wgs84_longitude`,
                        `coordinates`.`wgs84_latitude`,
                        `locations`.`region_id` as `region_id`,
                        `regions`.`name` as `region_name`,
                        `locations`.`municipality_id` as `municipality_id`,
                        `municipalities`.`name` as `municipality_name`,
                        `locations`.`cadastral_id` as `cadastral_municipality_id`,
                        `cadastral_municipalities`.`name` as `cadastral_municipality_name`,
                        `locations`.`portion` as `portion`,
                        `organic_waste`,
                        `construction_waste`,
                        `municipal_waste`,
                        `bulk_waste`,
                        `hazardous_waste`,
                        `tires`,
                        `vehicles`,
                        `asbestos_plates`,
                        `hazardous_liquids`

                    FROM
                        `dumps`
                         JOIN `irsops` on `irsops`.`id` = `dumps`.`irsop_id`
                         JOIN `volumes` on `volumes`.`id` = `dumps`.`volume_id`
                         JOIN `coordinates` on `coordinates`.`dump_id` = `dumps`.`id`
                         JOIN `locations` on `locations`.`dump_id` = `dumps`.`id`
                         JOIN `municipalities` on `locations`.`municipality_id` = `municipalities`.`id`
                         JOIN `regions` on `locations`.region_id = `regions`.`id`
                         JOIN `accesses` on `accesses`.id = `dumps`.`access_id`
                         JOIN `terrains` on `terrains`.id = `dumps`.`terrain_id`
                         JOIN `cadastral_municipalities` on `locations`.`cadastral_id` = `cadastral_municipalities`.`id`
                         JOIN `trash_types` on `trash_types`.`dump_id` = `dumps`.`id`
                    ";
        if ($type && $id) {
            $baseQuery .= " WHERE `{$type}`.`id` = {$id};";
        }
        $result = DB::select(DB::raw($baseQuery));
        return array_map(fn($e) => (array)$e, $result);
    }

    public function commentsByRegionOrMunicipality($type = null, $id = null): array
    {
        $baseQuery = "SELECT
                        `comments`.`dump_id` as `id`,
                        `comments`.`comment` as `comment`,
                        `comments`.`created_at` as `created_at`
                    FROM
                        `dumps`
                         JOIN `comments` on `comments`.`dump_id` = `dumps`.`id`
                         JOIN `locations` on `locations`.`dump_id` = `dumps`.`id`
                         JOIN `municipalities` on `locations`.`municipality_id` = `municipalities`.`id`
                         JOIN `regions` on `locations`.region_id = `regions`.`id`
                    ";
        if ($type && $id) {
            $baseQuery .= " WHERE `{$type}`.`id` = {$id};";
        }
        $result = DB::select(DB::raw($baseQuery));
        return array_map(fn($e) => (array)$e, $result);
    }
}

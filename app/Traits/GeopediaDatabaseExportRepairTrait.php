<?php

namespace App\Traits;

trait GeopediaDatabaseExportRepairTrait
{
    // It's possible to receive json file with following format: {}\n{}\n{}\n, so commas and [] wrapper needs to
    // be added to make it valid json
    public function attemptRepair(string $geoJson): array
    {
        $json = str_replace("}\n", "},", "[$geoJson]");
        $json = substr($json, 0, strlen($json) - 2) . ']';
        return json_decode($json, true);
    }
}

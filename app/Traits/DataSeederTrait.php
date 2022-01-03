<?php

namespace App\Traits;

trait DataSeederTrait
{
    // Returns the id of area estimate based on input area
    public function areaEstimate(mixed $area): int
    {
        // Return the 'missing' data id
        if(!is_numeric($area) || $area <= 0) {
            return 1;
        }

        $areaEstimatesLimits = [
            1, 3, 9, 24, 49, 99, 249, 499, 999, 2499, 4999, 10000
        ];
        foreach($areaEstimatesLimits as $index => $limit) {
            if($area <= $limit) {
                return $index + 2;
            }
        }
        // Default
        return 14;
    }

    public function volumeEstimate(string|null $type): int
    {
        return match ($type) {
            'Do 1m3 (en pralni stroj meri pol m3)' => 2,
            '1-2m3 (dve avtomobilski prikolici materiala)' => 3,
            '3-9m3 (velikost osebnega avtomobila)', '3-9m3  (velikost osebnega avtomobila)' => 4,
            '10-25m3' => 5,
            '25-50m3 (velikost enega do dveh avtobusov)' => 6,
            '50-100m3 (10 avtomobilov)' => 7,
            '100-250m3' => 8,
            '250-500m3' => 9,
            '500-1000m3 (100 avtomobilov)' => 10,
            'Nad 1000m3' => 11,
            default => 1,
        };
    }

    public function terrainType(string|null $type): int
    {
        return match ($type) {
            'Gorovje' => 2,
            'Hribovje' => 3,
            'Pobočje' => 4,
            'Gričevje' => 5,
            'Ravnina' => 6,
            'Kotanja' => 7,
            'Obalni ali priobalni pas' => 8,
            'Podzemlje' => 9,
            default => 1,
        };
    }

    public function accessType(string|null $type): int
    {
        return match ($type) {
            'Peš' => 2,
            'Osebni avto', 'Osebno vozilo' => 3,
            'Terenski avto', 'Terensko vozilo' => 4,
            'Nevaren dostop' => 5,
            'Nedostopno' => 6,
            default => 1,
        };
    }

    public function municipality(string|null $municipality, array $municipalities): int|null
    {
        if (is_null($municipality)) {
            return null;
        }
        $exceptions = [
            'Sveti Andraž v Slov. goricah' => 61,
        ];
        // Some names are not following convention, so we check for them here
        if (array_key_exists($municipality, $exceptions)) {
            return $exceptions[$municipality];
        }
        foreach ($municipalities as $municipalityData) {
            if (str_replace(' - ', '-', $municipalityData['name']) === $municipality) {
                return $municipalityData['id'];
            }
        }
        return null;
    }

    public function cadastralMunicipality(string|null $cadastralMunicipality, array $cadastralMunicipalities): int|null
    {
        if (is_null($cadastralMunicipality)) {
            return null;
        }
        // Some names are not following convention, so we check for them here
        $exceptions = [
            'MARIBOR-GRAD' => 657,
            'DOLJNI LESKOVEC' => 1358,
            'DALJNJI VRH' => 1454,
            'KRAN' => 2100,
            'GORNJI LESKOVEC' => 487,
            'ZAGORJE-MESTO' => 1886,
        ];
        if (array_key_exists(mb_strtoupper($cadastralMunicipality), $exceptions)) {
            return $exceptions[mb_strtoupper($cadastralMunicipality)];
        }
        foreach ($cadastralMunicipalities as $cadastralMunicipalityData) {
            if (mb_strtolower($cadastralMunicipalityData['name']) === mb_strtolower($cadastralMunicipality)) {
                return $cadastralMunicipalityData['id'];
            }
        }
        return null;
    }
}

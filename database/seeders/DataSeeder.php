<?php

namespace Database\Seeders;

use App\Models\CadastralMunicipality;
use App\Models\Municipality;
use App\Traits\DataSeederTrait;
use App\Traits\GeopediaDatabaseExportRepairTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataSeeder extends Seeder
{
    use DataSeederTrait, GeopediaDatabaseExportRepairTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $municipalities = Municipality::all(['id', 'name'])->toArray();
        $cadastralMunicipalities = CadastralMunicipality::all(['id', 'name'])->toArray();
        $userId = 1;

        // Scan for files and sort from newest to oldest
        $path = storage_path('app/geopedia_db_exports');
        $files = array_values(array_diff(scandir($path, SCANDIR_SORT_DESCENDING), ['.', '..']));

        $contents = file_get_contents("$path/$files[0]");
        // Get the latest file
        $geoJson = json_decode($contents, true);
        // If there is an error with json format, try to repair it
        if ($geoJson === null) {
            $repaired = $this->attemptRepair($contents);
            if ($repaired === null) {
                Log::error('Error repairing JSON file ' . $files[0]);
                die;
            }
            $geoJson = $repaired;
        }

        $dumps = collect([]);
        $dumpSplits = collect([]);
        $comments = collect([]);
        $geodeticInformation = collect([]);

        foreach ($geoJson as $dump) {
            $properties = $dump['properties'];
            $coordinates = $dump['geometry']['coordinates'][0];
            $id = $properties['_ID_'];
            $createdAt = $properties['Datum vnosa v register'];
            $updatedAt = $properties['Datum zadnje spremembe'];

            $dumps->add([
                'id' => $id,
                'title' => (is_null($properties['Naziv'])) ? ($properties['Občina'] ?? 'Odlagališče') . " - $id" : $properties['Naziv'],
                'description' => str_replace("\n", " ", strip_tags($properties['Opis in količina nevarnih odpadkov'])),
                'cleared' => $properties['Očiščeno'],
                'distance' => $properties['Oddaljenost od ceste [m]'],
                'has_hazardous_liquids' => $properties["Sodi z nevarno/neznano tekočino"],
                'coordinates' => DB::raw("POINT($coordinates[1], $coordinates[0])"),
                'user_id' => $userId,
                'volume_estimate_id' => $this->volumeEstimate($properties['Prostornina']),
                'area_estimate_id' => $this->areaEstimate($properties['Površina [m2]']),
                'access_type_id' => $this->accessType($properties['Dostop']),
                'terrain_type_id' => $this->terrainType($properties['Lega']),
                'municipality_id' => $this->municipality($properties['Občina'], $municipalities),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
            if (!is_null($properties['Opombe'])) {
                $comments->add([
                    'dump_id' => $id,
                    'user_id' => $userId,
                    'content' => str_replace("\n", " ", strip_tags($properties['Opombe'])),
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);
            }
            $dumpSplits->add([
                'dump_id' => $id,
                'organic_waste' => (int)$properties['Organski odpadki %'],
                'construction_waste' => (int)$properties['Gradbeni odpadki %'],
                'municipal_waste' => (int)$properties['Komunalni odpadki %'],
                'bulk_waste' => (int)$properties['Kosovni odpadki %'],
                'tires' => (int)$properties['Pnevmatike %'],
                'vehicles' => (int)$properties['Motorna vozila %'],
                'asbestos_plates' => (int)$properties['Salonitne plošče %'],
                'hazardous_waste' => (int)$properties['Nevarni odpadki %'],
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
            $geodeticInformation->add([
                'dump_id' => $id,
                'cadastral_municipalities_id' => $this->cadastralMunicipality($properties['Katastrska obcina'], $cadastralMunicipalities),
                'portion' => (string)$properties['Parcela'],
            ]);
        }

        $tables = [
            'dumps' => &$dumps,
            'dump_splits' => &$dumpSplits,
            'comments' => &$comments,
            'geodetic_information' => &$geodeticInformation,
        ];

        foreach ($tables as $table => $data) {
            // Calculate appropriate amount of chunks by doing 65000 / number_of_columns
            $data->chunk(4000)->each(function (Collection $data) use ($table) {
                DB::table($table)->insert($data->toArray());
            });
        }
    }
}

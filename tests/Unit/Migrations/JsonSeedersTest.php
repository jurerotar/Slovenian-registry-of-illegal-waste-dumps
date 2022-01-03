<?php

namespace Tests\Unit\Migrations;

use Tests\TestCase;

class JsonSeedersTest extends TestCase
{
    private array $seeders = [
        'regions.json' => [
            'id' => 'integer',
            'name' => 'string',
            'population' => 'integer',
            'area' => 'integer|float|double',
            'population_per_area' => 'integer',
            'slug' => 'string',
            'created_at' => 'string',
            'updated_at' => 'string',
        ],
        'municipalities.json' => [
            'id' => 'integer',
            'region_id' => 'integer',
            'name' => 'string',
            'population' => 'integer',
            'area' => 'integer|float|double',
            'population_per_area' => 'integer',
            'villages' => 'integer',
            'slug' => 'string',
            'created_at' => 'string',
            'updated_at' => 'string',
        ],
        'cadastral_municipalities.json' => [
            'id' => 'integer',
            'name' => 'string',
        ],
        'inspectorates.json' => [
            'id' => 'integer',
            'name' => 'string',
            'address' => 'string|null',
            'email' => 'string|null',
            'tel' => 'string|null',
            'url' => 'string|null',
            'type' => 'string',
            'created_at' => 'string',
            'updated_at' => 'string',
        ],
//        'users.json' => [
//            'id' => 'integer',
//            'created_at' => 'string',
//            'updated_at' => 'string',
//        ],
        'inspectorate_municipality.json' => [
            'inspectorate_id' => 'integer',
            'municipality_id' => 'integer',
            'created_at' => 'string',
            'updated_at' => 'string',
        ],
        'volume_estimates.json' => [
            'id' => 'integer',
            'volume' => 'string',
            'description' => 'string',
            'average' => 'integer',
        ],
        'area_estimates.json' => [
            'id' => 'integer',
            'area' => 'string',
            'description' => 'string',
            'average' => 'integer',
        ],
        'access_types.json' => [
            'id' => 'integer',
            'type' => 'string',
            'description' => 'string',
        ],
        'terrain_types.json' => [
            'id' => 'integer',
            'type' => 'string',
            'description' => 'string',
        ],
    ];

    public function testSeedFileExistence(): void
    {
        $seeders = array_keys($this->seeders);
        foreach ($seeders as $seeder) {
            $this->assertTrue(file_exists(database_path("/json/$seeder")), "$seeder is missing");
        }
    }

    public function testSeedDataValidity(): void
    {
        foreach ($this->seeders as $seeder => $keysWithTypes) {
            $data = json_decode(file_get_contents(database_path("/json/$seeder")), true);
            // Check if data is correctly formed
            if ($data === null) {
                $this->fail("$seeder is not correctly formed: " . json_last_error_msg());
            }
            foreach ($data as $object) {
                // Check if each object has correct keys
                if (count(array_diff_key($keysWithTypes, $object)) > 0) {
                    $this->fail("Object with id of $object[0] in $seeder has incorrect keys.");
                }
                // Check if each property is of correct type
                foreach ($object as $key => $value) {
                    // Type from tests
                    $correctTypes = explode('|', $keysWithTypes[$key]);
                    $type = strtolower(gettype($value));
                    if (!in_array($type, $correctTypes)) {
                        $this->fail(
                            "Property \{$key} in object with id $object[0] in $seeder is of wrong type.
                        Expected: ". join('|', $correctTypes) . ", got $type"
                        );
                    }
                }
            }
            $this->assertTrue(true);
        }
    }
}

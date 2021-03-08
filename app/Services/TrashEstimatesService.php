<?php


namespace App\Services;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;


class TrashEstimatesService
{

    private array $keys;
    private CacheService $cache;
    private array $attributes = [
        'organic_waste' => 'Organski odpadki',
        'construction_waste' => 'Gradbeni odpadki',
        'municipal_waste' => 'Komunalni odpadki',
        'bulk_waste' => 'Kosovni odpadki',
        'hazardous_waste' => 'Nevarni odpadki',
        'tires' => 'Pnevmatike',
        'vehicles' => 'Vozila',
        'asbestos_plates' => 'Salonitne plošče',
    ];

    #[Pure]
    public function __construct()
    {
        $this->keys = array_keys($this->attributes);
        $this->cache = new CacheService();
    }

    #[ArrayShape([
        [
            'id' => "int",
            'name' => "string",
            'volume' => "int",
            'percentage' => "float"
        ]
    ])]
    public function get(): array
    {
        return $this->merge($this->volume(), $this->percentage());
    }

    /**
     * Returns calculated sums for columns in estimated_trash_volumes
     * Rewrote method from Eloquent to raw SQL query, since raw computes 3-4x faster
     * @return Collection
     */
    private function volume(): Collection
    {
        return $this->cache->cache('summed_estimated_trash_volume', function (): Collection {
            return DB::table('estimated_trash_volumes')
                ->selectRaw($this->constructRawQuery('sum'))
                ->join('dumps', 'estimated_trash_volumes.dump_id', '=', 'dumps.id')
                ->where('dumps.cleared', false)
                ->get()->mapWithKeys(fn($e) => $e);
        });
    }

    /**
     * Returns calculated averages for columns in trash_types
     * Rewrote method from Eloquent to raw SQL query, since raw computes 3-4x faster
     * @return Collection
     */
    private function percentage(): Collection
    {
        return $this->cache->cache('trash_type_percentages', function (): Collection {
            return DB::table('trash_types')
                ->selectRaw($this->constructRawQuery('avg'))
                ->join('dumps', 'trash_types.dump_id', '=', 'dumps.id')
                ->where('dumps.cleared', false)
                ->get()->mapWithKeys(fn($e) => $e);
        });
    }

    #[ArrayShape([
        [
            'id' => "int",
            'name' => "string",
            'volume' => "int",
            'percentage' => "float"
        ]
    ])]
    private function merge(Collection $volumes, Collection $percentages): array
    {
        $combined = [];
        $length = count($this->attributes);
        for ($i = 0; $i < $length; $i++) {
            $key = $this->keys[$i];
            $combined[] = [
                'id' => $i + 1,
                'name' => $this->attributes[$key],
                'volume' => (int)$volumes[$key],
                'percentage' => (float)$percentages[$key]
            ];
        }
        return $combined;
    }

    /**
     * Returns raw query for set operator on all columns set in $attributes
     * @param string $operator
     * @return string
     */
    private function constructRawQuery(string $operator): string
    {
        return implode(', ', array_map(function (string $column) use ($operator): string {
            return "{$operator}(`{$column}`) as `{$column}`";
        }, $this->keys));
    }
}

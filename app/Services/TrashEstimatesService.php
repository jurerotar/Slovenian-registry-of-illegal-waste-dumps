<?php


namespace App\Services;


use App\Models\EstimatedTrashVolume;
use App\Models\TrashType;
use App\Traits\RetrieveFromCacheTrait;
use RecursiveArrayIterator;


class TrashEstimatesService
{
    use RetrieveFromCacheTrait;

    private array $keys;
    private string $volumeKey = 'summed_estimated_trash_volume';
    private string $percentageKey = 'trash_type_percentages';
    private array $attributes = [
        'organic_waste' => 'Organski odpadki',
        'construction_waste' => 'Gradbeni odpadki',
        'municipal_waste' => 'Komunalni odpadki',
        'bulk_waste' => 'Kosovni odpadki',
        'hazardous_waste' => 'Nevarni odpadki',
        'tires' => 'Pnevmatike',
        'vehicles' => 'Vozila',
        'asbestos_plates' => 'Salonitne plošče'
    ];

    public function __construct()
    {
        $this->keys = array_keys($this->attributes);
    }

    public function volume(): array
    {
        return $this->getOrSet($this->volumeKey, function () {
            $estimatedTrashVolumes = EstimatedTrashVolume::whereHas('dump', fn($e) => $e->where('cleared', false))->get();
            $amounts = [];
            foreach ($this->keys as $column) {
                $amounts[$column] = $estimatedTrashVolumes->sum($column);
            }
            return $amounts;
        });
    }

    public function percentage()
    {
        return $this->getOrSet($this->percentageKey, function () {
            $trashTypes = TrashType::whereHas('dump', fn($e) => $e->where('cleared', false))->get();
            $percentages = [];
            foreach ($this->keys as $column) {
                $percentages[$column] = $trashTypes->avg($column);
            }
            return $percentages;
        });
    }

    public function volumeAndPercentageJson(): array
    {
        $percentages = $this->percentage();
        $volumes = $this->volume();
        $combined = [];
        $length = count($this->attributes);
        for ($i = 0; $i < $length; $i++) {
            $key = $this->keys[$i];
            $combined[] = [
                'id' => $i + 1,
                'name' => $this->attributes[$key],
                'volume' => $volumes[$key],
                'percentage' => $percentages[$key]
            ];
        }
        return $combined;
    }
}

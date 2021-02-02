<?php


namespace App\Services;


use App\Models\Dump;
use Illuminate\Support\Facades\Cache;

// TODO: refactor this, this class does a bit too much

class TrashEstimatesService
{
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
        return Cache::get($this->volumeKey, function () {
            $amounts = [];
            $estimatedTrashVolumes = Dump::with('estimatedTrashVolume')
                ->where('cleared', '=', false)
                ->get()->map(function ($e) {
                    return $e->estimatedTrashVolume;
                });
            foreach ($this->attributes as $attribute => $translation) {
                $amounts[$attribute] = $estimatedTrashVolumes->sum($attribute);
            }
            Cache::put($this->volumeKey, $amounts);
            return $amounts;
        });
    }

    public function percentage()
    {
        return Cache::get($this->percentageKey, function () {
            $percentages = [];
            $trashTypes = Dump::with('trashType')
                ->where('cleared', '=', false)
                ->get()->map(function ($e) {
                    return $e->trashType;
                });
            $numberOfRows = $trashTypes->count();
            foreach ($this->attributes as $attribute => $translation) {
                $percentages[$attribute] = round($trashTypes->sum($attribute) / $numberOfRows, 2);
            }
            Cache::put($this->percentageKey, $percentages);
            return $percentages;
        });
    }

    public function clear(bool $volume = true, bool $percentage = true): void
    {
        if ($volume) {
            Cache::forget($this->volumeKey);
        }
        if ($percentage) {
            Cache::forget($this->percentageKey);
        }
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

<?php


namespace App\Services;


use App\Models\Dump;
use JetBrains\PhpStorm\Pure;

class RegionDumpDataService
{
    private CacheService $cache;

    #[Pure] public function __construct()
    {
        $this->cache = new CacheService();
    }

    public function dumps(): array
    {
        return $this->cache->cache('dump_count_by_region', function (): array {
            $regions = $this->cache->regions();
            $ids = $regions->pluck(['id']);
            $allRegionIdsByDumps = Dump::with('region:id')->get(['id', 'cleared', 'dangerous']);

            return $ids->map(function (int $id) use ($allRegionIdsByDumps, $regions): array {
                $dumpsByRegion = $allRegionIdsByDumps->filter(fn($dump) => $dump->region->id === $id);
                $total = $dumpsByRegion->count();
                $cleared = $dumpsByRegion->filter(fn($dump) => $dump->cleared === true)->count();
                $uncleared = $total - $cleared;
                $region = $regions->find($id);
                return [
                    'id' => $id,
                    'total' => $total,
                    'dangerous' => $dumpsByRegion->filter(fn($regions) => $regions->dangerous === true && $regions->cleared === false)->count(),
                    'cleared' => $cleared,
                    'uncleared' => $uncleared,
                    'area' => $region->area,
                    'population' => $region->population,
                ];
            })->toArray();
        });
    }
}

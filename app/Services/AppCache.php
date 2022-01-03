<?php


namespace App\Services;

use App\Models\CadastralMunicipality;
use App\Models\Municipality;
use App\Models\ReferenceModels\AccessType;
use App\Models\ReferenceModels\TerrainType;
use App\Models\ReferenceModels\VolumeEstimate;
use App\Models\Region;
use Closure;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class AppCache
{

    /**
     * These methods try to retrieve data by name from the cache and if it fails, fires a callback that retrieves
     * data, saves it to cache with key and then returns data.
     */
    public static function get(string $key, Closure $default = null): mixed
    {
        return Cache::get($key, function () use ($key, $default) {
            if (!is_callable($default)) {
                return null;
            }
            $data = $default();
            // Cache data in production
            if (App::environment('production')) {
                Cache::put($key, $data);
            }
            return $data;
        });
    }

    // Data from table 'regions' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function regions(): Collection
    {
        return self::get('regions', fn(): Collection => Region::all());
    }

    // Data from table 'municipalities' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function municipalities(): Collection
    {
        return self::get('municipalities', fn(): Collection => Municipality::all());
    }

    // Data from table 'cadastral_municipalities' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function cadastralMunicipalities(): Collection
    {
        return self::get('cadastral_municipalities', fn(): Collection => CadastralMunicipality::all());
    }


    // Data from table 'access_types' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function accessTypes(): Collection
    {
        return self::get('access_types', fn(): Collection => AccessType::all());
    }


    // Data from table 'volume_estimates' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function volumeEstimates(): Collection
    {
        return self::get('volume_estimates', fn(): Collection => VolumeEstimate::all());
    }

    // Data from table 'terrain_types' will not change and should be retrieved from cache to prevent unnecessary queries
    public static function terrainTypes(): Collection
    {
        return self::get('terrain_types', fn(): Collection => TerrainType::all());
    }

    public static function exportPageData(): Collection
    {
        return self::get('export_page_data', function (): Collection {
            return Region::with([
                'municipalities:id,slug,name,region_id',
                'municipalities.dumps' => fn(HasMany $dumps): HasMany => $dumps->orderByDesc('updated_at'),
                'municipalities.dumps:id,updated_at,municipality_id',
            ])->withCount([
                'dumps as dump_count'
            ])->get(['regions.id', 'regions.slug', 'regions.name']);
        });
    }

}

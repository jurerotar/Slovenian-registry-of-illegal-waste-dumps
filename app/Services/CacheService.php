<?php


namespace App\Services;

use App\Models\Access;
use App\Models\CadastralMunicipality;
use App\Models\Irsop;
use App\Models\Municipality;
use App\Models\Region;
use App\Models\Terrain;
use App\Models\Volume;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

// todo: uncomment caching when on production
class CacheService
{

    /**
     * This methods tries to retrieve data by name from the cache and if it fails, fires a callback that retrieves
     * data, saves it to cache with key and then returns data.
     * @param string $name - cache key
     * @param Closure|null $callback
     * @return mixed
     */
    public function cache(string $name, Closure $callback = null)
    {
        return Cache::get($name, function () use ($name, $callback) {
            $data = $callback();
            //Cache::put($name, $data);
            return $data;
        });
    }

    /**
     * Data from table 'regions' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function regions(): Collection
    {
        return $this->cache('regions', function () {
            return Region::all();
        });
    }

    /**
     * Data from table 'municipalities' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function municipalities(): Collection
    {
        return $this->cache('municipalities', function () {
            return Municipality::all();
        });
    }

    /**
     * Data from table 'cadastral_municipalities' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function cadastralMunicipalities(): Collection
    {
        return $this->cache('cadastral_municipalities', function () {
            return CadastralMunicipality::all();
        });
    }

    /**
     * Data from table 'accesses' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function accesses(): Collection
    {
        return $this->cache('accesses', function () {
            return Access::all();
        });
    }

    /**
     * Data from table 'volumes' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function volumes(): Collection
    {
        return $this->cache('volumes', function () {
            return Volume::all();
        });
    }

    /**
     * Data from table 'irsops' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function irsops(): Collection
    {
        return $this->cache('irsops', function () {
            return Irsop::all();
        });
    }

    /**
     * Data from table 'terrains' will not change and should be retrieved from cache to prevent unnecessary queries
     * @return Collection
     */
    public function terrains(): Collection
    {
        return $this->cache('terrains', function () {
            return Terrain::all();
        });
    }

}

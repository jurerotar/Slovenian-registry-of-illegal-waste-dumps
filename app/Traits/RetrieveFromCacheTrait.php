<?php


namespace App\Traits;

use Illuminate\Support\Facades\Cache;

// todo: uncomment caching when on production
trait RetrieveFromCacheTrait
{
    /**
     * This methods tries to retrieve data by name from the cache and if it fails, fires a callback that retrieves
     * data, saves it to cache with key and then returns data.
     * @param string $name
     * @param callable $callback
     * @return mixed
     */
    public function getOrSet(string $name, callable $callback)
    {
        return Cache::get($name, function () use ($name, $callback) {
            $data = $callback();
            //Cache::put($name, $data);
            return $data;
        });
    }
}

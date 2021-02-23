<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Services\CacheService;

class GlobalDataController extends Controller
{

    private CacheService $cache;

    public function __construct()
    {
        $this->cache = new CacheService();
    }

    /**
     * Dumps global data in to window.globalData variable in app.blade.php in json form.
     * This data is used to populate layout.
     * @return string
     */
    public function index(): string
    {
        return json_encode([
            /**
             * Retrieves all regions and municipalities in those regions
             */
            'regions' => $this->cache->cache('regions_with_municipalities', function () {
                return Region::with(['municipalities:region_id,id,name,slug'])
                    ->get(['id', 'name', 'slug'])
                    ->each(fn($e) => $e->municipalities->makeHidden('region_id'));
            }),
        ]);
    }
}

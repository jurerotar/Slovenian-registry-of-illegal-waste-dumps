<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Services\CacheService;

/**
 * Class TestController
 * @package App\Http\Controllers
 * This controller is used only for testing purposes
 */
class TestController extends Controller
{
    private CacheService $cache;

    public function __construct()
    {
        $this->cache = new CacheService();
    }

    private function query()
    {
        return json_encode([
            0 => $this->cache->cache('regions_with_municipalities', function () {
                return Region::with(['municipalities:region_id,id,name,slug'])
                    ->get(['id', 'name', 'slug'])
                    ->each(fn($e) => $e->municipalities->makeHidden('region_id'));
            })
        ]);
    }

    public function index()
    {
        dump($this->query());
    }
}

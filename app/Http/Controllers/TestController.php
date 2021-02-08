<?php

namespace App\Http\Controllers;

use App\Models\Region;

/**
 * Class TestController
 * @package App\Http\Controllers
 * This controller is used only for testing purposes
 */
class TestController extends Controller
{
    public function index()
    {
        $amountByRegion = Region::with(['municipalities:region_id,id,name'])->select(['id', 'name'])
            ->get()->each(fn($e) => $e->municipalities->makeHidden('region_id'))
            ->toArray();
        dump($amountByRegion);
    }
}

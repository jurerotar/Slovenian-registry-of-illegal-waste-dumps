<?php

namespace App\Http\Controllers;

use App\Http\Resources\MunicipalityResource;
use App\Models\Dump;
use App\Services\CacheService;
use Illuminate\Database\Eloquent\Builder;

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
        $id = 180;
        return MunicipalityResource::collection(Dump::with(['access:id,type', 'trashType', 'terrain:id,type', 'volume:id', 'location', 'comments' => function ($q) {
            $q->with('user:id,name')->select(['user_id', 'dump_id', 'comment', 'updated_at']);
        }])
            ->whereHas('municipality', function (Builder $municipality) use ($id) {
                $municipality->whereId($id);
            })->get());
    }

    public function index()
    {
        return $this->query();
    }
}

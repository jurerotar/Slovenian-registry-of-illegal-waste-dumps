<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaHelper;
use App\Http\Resources\MunicipalityResource;
use App\Models\Dump;
use App\Models\Municipality;
use App\Services\CacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Response;
use JetBrains\PhpStorm\Pure;

class MunicipalityPageController extends Controller
{
    private CacheService $cache;

    #[Pure]
    public function __construct()
    {
        $this->cache = new CacheService();
    }

    public function show(Municipality $municipality): Response
    {
        return InertiaHelper::serverRender('Map', [
            'dumps' => $this->dumps($municipality->id),
            'additional' => [
                'volumes' => $this->cache->volumes(),
            ],
        ]);
    }

    public function dumps(int $id): AnonymousResourceCollection
    {
        return MunicipalityResource::collection(Dump::with([
            'access:id,type',
            'trashType',
            'terrain:id,type',
            'volume:id',
            'location',
            'comments' => fn($q) => $q->with('user:id,name')->select(['user_id', 'dump_id', 'comment', 'updated_at']),
        ])->whereHas('municipality', fn(Builder $municipality) => $municipality->whereId($id))
            ->get());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\MunicipalityResource;
use App\Models\Dump;
use App\Models\Municipality;
use App\Services\CacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
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

    public function index(Municipality $municipality): Response
    {
        // Push title and description to info for vue to use
        $meta = collect([
            'title' => __('meta.municipality.title', ['name' => $municipality->name]),
            'desc' => __('meta.municipality.description', ['name' => $municipality->name]),
            'page' => 'obcina',
        ]);

        return Inertia::render('Municipality', [
            'meta' => $meta,
            'dumps' => $this->dumps($municipality->id),
            'additional' => [
                'volumes' => $this->cache->volumes(),
            ],

        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
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

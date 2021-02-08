<?php

namespace App\Http\Controllers;

use App\Models\Dump;
use App\Models\Region;
use App\Services\ExportFileMetadataService;
use App\Services\TrashEstimatesService;
use App\Traits\RetrieveFromCacheTrait;
use Inertia\Inertia;
use Inertia\Response;

class PageDataController extends Controller
{
    use RetrieveFromCacheTrait;

    /**
     * Dumps global data in to window.globalData variable in app.blade.php in json form.
     * This data is used to populate layout.
     * @return string
     */
    public function global(): string
    {
        return json_encode([
            /**
             * Retrieves all regions and municipalities in those regions
             */
            'regions' => $this->getOrSet('regions_with_municipalities', function () {
                return Region::with(['municipalities:region_id,id,name'])
                    ->get(['id', 'name'])
                    ->each(fn($e) => $e->municipalities->makeHidden('region_id'))
                    ->toArray();
            }),
        ]);
    }

    public function home(): Response
    {
        return Inertia::render('Home', [
            /**
             * Sets current page name to 'home'
             */
            'currentPage' => 'home',
            /**
             * Returns calculated volumes and percentages of each trash type
             */
            'trash' => (new TrashEstimatesService())->volumeAndPercentageJson(),
            'dumpsByRegion' => $this->getOrSet('dumps_by_region', function () {
                return Region::all(['id'])->map(function ($collection) {
                    return [
                        'id' => $collection->id,
                        'amount' => Dump::whereHas('region', fn($e) => $e->where('id', $collection->id))->count()
                    ];
                });
            }),
        ]);
    }

    public function export(): Response
    {
        return Inertia::render('Export', [
            /**
             * Sets current page name to 'export'
             */
            'currentPage' => 'export',
            /**
             * Retrieves metadata for files stored in app/public/{municipalities|regions}
             */
            'metadata' => (new ExportFileMetadataService)->get(),
        ]);
    }

    public function report(): Response
    {
        return Inertia::render('Report', [
            /**
             * Sets current page name to 'report'
             */
            'currentPage' => 'report',

        ]);
    }

    public function region(): Response
    {
        return Inertia::render('Region', [
            /**
             * Sets current page name to 'region'
             */
            'currentPage' => 'region',

        ]);
    }

    public function municipality(): Response
    {
        return Inertia::render('Municipality', [
            /**
             * Sets current page name to 'municipality'
             */
            'currentPage' => 'municipality',

        ]);
    }
}

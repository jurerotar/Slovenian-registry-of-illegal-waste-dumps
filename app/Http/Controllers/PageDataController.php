<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Services\TrashEstimatesService;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class PageDataController extends Controller
{
    /**
     * Dumps global data in to window.globalData variable in app.blade.php in json form
     * @return string
     */
    public static function global(): string
    {
        return json_encode([
            'regions' => Cache::get('regions_with_municipalities', function () {
                $data = Region::with('municipalities')->get()
                    ->each(fn($e) => $e->municipalities->makeHidden(['region_id']))->toArray();
                Cache::put('regions_with_municipalities', $data);
                return $data;
            }),

        ]);
    }

    public function home(): Response
    {
        $estimateService = new TrashEstimatesService();
        return Inertia::render('Home', [
            'trash' => $estimateService->volumeAndPercentageJson(),
        ]);
    }

    public function export(): Response
    {
        return Inertia::render('Export', [

        ]);
    }

    public function report(): Response
    {
        return Inertia::render('Report', [

        ]);
    }

    public function region(): Response
    {
        return Inertia::render('Region', [

        ]);
    }

    public function municipality(): Response
    {
        return Inertia::render('Municipality', [

        ]);
    }
}

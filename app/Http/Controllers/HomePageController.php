<?php

namespace App\Http\Controllers;

use App\Services\RegionDumpDataService;
use App\Services\TrashEstimatesService;
use Inertia\Inertia;
use Inertia\Response;

class HomePageController extends Controller
{

    public function index(): Response
    {

        $meta = collect([
            'title' => __('meta.home.title'),
            'desc' => __('meta.home.description'),
            'page' => 'domov',
        ]);
        return Inertia::render('Home', [
            'meta' => $meta,
            'trash' => $this->trashEstimates(),
            'regionDumpData' => $this->regionDumpData(),
        ])->withViewData([
            'title' => $meta->get('title'),
            'description' => $meta->get('desc'),
        ]);
    }

    /**
     * Returns calculated volumes and percentages of each trash type
     * @return array
     */
    private function trashEstimates(): array
    {
        return (new TrashEstimatesService())->get();
    }

    /**
     * Returns nested array of data for RegionMap component
     * @return array
     */
    private function regionDumpData(): array
    {
        return (new RegionDumpDataService())->dumps();
    }

}

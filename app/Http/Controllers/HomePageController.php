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
        return Inertia::render('Home', [
            /**
             * Sets current page name to 'home'
             */
            'currentPage' => 'domov',
            'trash' => $this->trashEstimates(),
            'regionDumpData' => $this->regionDumpData()
        ])->withViewData([
            'title' => __('meta.home.title'),
            'description' => __('meta.home.description')
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

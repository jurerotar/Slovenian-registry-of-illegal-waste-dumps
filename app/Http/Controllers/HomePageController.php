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
     */
    private function trashEstimates(): array
    {
        return (new TrashEstimatesService())->get();
    }

    private function regionDumpData(): array
    {
        return (new RegionDumpDataService())->dumps();
    }

}

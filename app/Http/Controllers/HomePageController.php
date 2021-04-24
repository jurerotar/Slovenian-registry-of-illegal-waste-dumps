<?php

namespace App\Http\Controllers;

use App\Helpers\InertiaHelper;
use App\Services\RegionDumpDataService;
use App\Services\TrashEstimatesService;
use Inertia\Response;

class HomePageController extends Controller
{

    public function show(): Response
    {
        return InertiaHelper::serverRender('Home', [
            'trash' => $this->trashEstimates(),
            'regionDumpData' => $this->regionDumpData(),
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

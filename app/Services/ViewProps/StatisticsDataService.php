<?php

namespace App\Services\ViewProps;

use Illuminate\Support\Collection;

class StatisticsDataService
{
    public function __invoke(): Collection
    {
//        return Dump::with([
//            'areaEstimate',
//            'volumeEstimate',
//            'dumpSplit'
//        ])
//            ->get();
        return collect([]);
    }
}

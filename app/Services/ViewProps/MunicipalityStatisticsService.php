<?php

namespace App\Services\ViewProps;

use App\Models\Municipality;
use Illuminate\Support\Collection;

class MunicipalityStatisticsService
{
    public function __invoke(): Collection
    {
        return Municipality::select(['id', 'slug', 'name'])
            ->withCount(['dumps', 'clearedDumps',])
            ->get();
    }
}

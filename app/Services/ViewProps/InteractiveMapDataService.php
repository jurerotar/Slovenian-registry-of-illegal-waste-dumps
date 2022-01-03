<?php

namespace App\Services\ViewProps;

use App\Models\Region;
use Illuminate\Support\Collection;

class InteractiveMapDataService
{
    public function __invoke(): Collection
    {
        return Region::withCount([
            'dumps as total_dumps',
            'dumps as cleared_dumps' => fn($q) => $q->whereCleared(true),
        ])
            ->get([
                'id',
                'slug',
                'name',
                'population',
                'area'
            ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Region;
use App\Services\AppCache;
use Illuminate\Database\Eloquent\Collection;

class PublicPagesController
{
    public function navigation(): string
    {
        return AppCache::get('navigation_data', function (): Collection {
            return Region::with(['municipalities:region_id,id,name,slug'])
                ->get(['id', 'name', 'slug']);
        })
            ->toJson();
    }
}

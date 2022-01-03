<?php

namespace App\Services\ViewProps;

use App\Models\Region;
use App\Services\AppCache;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class ExportDataService
{
    public function __invoke(): Collection
    {
        return AppCache::get('export_page_data', function (): Collection {
            return Region::with([
                'municipalities:id,slug,name,region_id',
                'municipalities.dumps' => fn(HasMany $dumps): HasMany => $dumps->orderByDesc('updated_at'),
                'municipalities.dumps:id,updated_at,municipality_id',
            ])
                ->withCount([
                    'dumps as dump_count'
                ])
                ->get([
                    'regions.id',
                    'regions.slug',
                    'regions.name'
                ]);
        });
    }
}

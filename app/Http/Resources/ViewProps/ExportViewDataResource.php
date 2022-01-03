<?php

namespace App\Http\Resources\ViewProps;

use App\Models\Municipality;
use App\Models\Region;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use function collect;

class ExportViewDataResource extends JsonResource
{

    public function toArray(mixed $request): array|JsonSerializable|Arrayable
    {
        return $this->map(function (Region $region): array {
            $municipalities = $region->municipalities;
            // Region update_at is the same as the last updated dump in that region
            $regionLastUpdated = collect($municipalities->map(function (Municipality $municipality) {
                $dumps = $municipality->dumps;
                return !is_null($dumps->first()) ? $dumps->first()->updated_at->timestamp : 0;
            }))->max();
            return [
                'id' => $region->id,
                'name' => $region->name,
                'slug' => $region->slug,
                'updated_at' => $regionLastUpdated,
                'dump_count' => $region->dump_count,
                'municipalities' => $municipalities->map(function (Municipality $municipality): array {
                    $dumps = $municipality->dumps;
                    return [
                        'id' => $municipality->id,
                        'name' => $municipality->name,
                        'slug' => $municipality->slug,
                        'updated_at' => !is_null($dumps->first()) ? $dumps->first()->updated_at->timestamp : null,
                        'dump_count' => $dumps->count(),
                    ];
                }),
            ];
        });
    }
}

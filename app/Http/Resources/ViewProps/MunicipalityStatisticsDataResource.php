<?php

namespace App\Http\Resources\ViewProps;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityStatisticsDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'total' => $this->dumps_count,
            'cleared' => $this->clared_dumps_count,
        ];
    }
}

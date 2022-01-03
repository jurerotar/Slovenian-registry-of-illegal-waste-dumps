<?php

namespace App\Http\Resources\ViewProps;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class InteractiveMapDataResource extends JsonResource
{

    #[ArrayShape([
        'id' => "int",
        'slug' => "int",
        'name' => "int",
        'total' => "int",
        'cleared' => "int",
        'uncleared' => "int",
        'area' => "int",
        'population' => "int"
    ])]
    public function toArray(mixed $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'total' => $this->total_dumps,
            'cleared' => $this->cleared_dumps,
            'uncleared' => $this->total_dumps - $this->cleared_dumps,
            'area' => $this->area,
            'population' => $this->population,
        ];
    }
}

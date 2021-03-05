<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'desc' => $this->description,
            'dangerous' => $this->dangerous,
            'cleared' => $this->cleared,
            'urgent' => $this->urgent,
            'terrain' => $this->terrain->type,
            'access' => $this->access->type,
            'volume' => $this->volume->id,
            'location' => [
                'lat' => $this->location->wgs84_latitude,
                'lon' => $this->location->wgs84_longitude,
            ],
            'trash_types' => [
                "organic_waste" => $this->when($this->trashType->organic_waste > 0, $this->trashType->organic_waste),
                "construction_waste" => $this->when($this->trashType->construction_waste > 0, $this->trashType->construction_waste),
                "municipal_waste" => $this->when($this->trashType->municipal_waste > 0, $this->trashType->municipal_waste),
                "bulk_waste" => $this->when($this->trashType->bulk_waste > 0, $this->trashType->bulk_waste),
                "hazardous_waste" => $this->when($this->trashType->hazardous_waste > 0, $this->trashType->hazardous_waste),
                "tires" => $this->when($this->trashType->tires > 0, $this->trashType->tires),
                "vehicles" => $this->when($this->trashType->vehicles > 0, $this->trashType->vehicles),
                "asbestos_plates" => $this->when($this->trashType->asbestos_plates > 0, $this->trashType->asbestos_plates),
                "hazardous_liquids" => $this->when($this->trashType->hazardous_liquids > 0, $this->trashType->hazardous_liquids),
            ],
            'date' => $this->updated_at->timestamp,
            'comments' => $this->when($this->comments->count() > 0, $this->comments->map(function ($e) {
                return [
                    'name' => $e->user->name,
                    'comment' => $e->comment,
                    'date' => $e->updated_at->timestamp,
                ];
            })),
        ];
    }
}

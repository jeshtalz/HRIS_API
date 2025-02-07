<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionDescriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $plantilla = $this->whenLoaded('belongsToPlantilla');

        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "description" => (string)$this->description,
            ],
            "plantilla" => new PlantillaResource($plantilla),
            
        ];
    }
}

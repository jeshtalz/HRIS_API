<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalaryGradeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $position =  $this->whenLoaded('hasManyPosition');
        return [
            "id" => (string)$this->id,
            "attributes"=>[
                "number" => (string)$this->number,
                "amount" => (string)$this->amount,
            ],
            "positions" => new PositionResource($position),
            
        ];
    }
}

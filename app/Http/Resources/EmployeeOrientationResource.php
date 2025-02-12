<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeOrientationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ([
            "id" => (string)$this->id,
            "attributes"=>[
                
                "employee_id" => (string)$this->employee_id,
                "orientation_id" => (string)$this->orientation_id,
                "employee"=> new EmployeeResource($this->whenLoaded('belongsToEmployee')),
                
            ]
            ]);
    }
}

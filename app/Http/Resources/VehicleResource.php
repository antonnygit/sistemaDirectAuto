<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "release_model" => $this->release_model,
            "release_year" => $this->release_year,
            "color" => $this->color,
            "km" => $this->km,
            "image" => $this->image ? Storage::url($this->image) : null,
            "description" => $this->description,
            "price" => $this->price,
            "brand_id" => $this->brand_id,
            "status_id" => $this->status_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'reference' => $this->reference,
            'type' => $this->type,
            'description' => $this->description,
            'stock_quantity' => $this->stock_quantity,
            'price' => (float) $this->price,
            'specifications' => $this->specifications,
            'is_in_stock' => $this->isInStock(),
            'is_low_stock' => $this->isLowStock(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}


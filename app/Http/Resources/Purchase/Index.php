<?php

namespace App\Http\Resources\Purchase;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Index extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'value' => $this->resource->value,
            'type' => $this->resource->type,
            'date' => $this->resource->date,
            'description' => $this->resource->description,
            'invoice_id' => $this->resource->invoice_id,
        ];
    }
}
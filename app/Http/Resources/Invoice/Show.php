<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Show extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'invoice' => $this->resource['invoice'] = [
                'id' => $this->resource['invoice']['id'],
                'date' => $this->resource['invoice']['date'],
                'total' => $this->resource['invoice']['total'],
            ],
            'purchases' => $this->resource['purchases']
        ];
    }
}
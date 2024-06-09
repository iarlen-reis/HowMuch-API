<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NextInvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total' => $this->resource['total'],
            'invoices' => $this->resource['invoices']->map(function ($invoice) {
                return [
                    'id' => $invoice->id,
                    'date' => $invoice->date,
                    'total' => $invoice->total,
                ];
            })
        ];
    }
}

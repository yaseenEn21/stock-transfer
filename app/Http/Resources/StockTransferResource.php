<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockTransferResource extends JsonResource
{
    /**
     * تحويل البيانات إلى مصفوفة JSON.
     */
    public function toArray($request): array
    {
        return [
            'id'                     => $this->id,
            'delivery_integration_id'=> $this->delivery_integration_id,
            'warehouse_from_id'      => $this->warehouse_from_id,
            'warehouse_to_id'        => $this->warehouse_to_id,
            'status'                 => $this->status,
            'notes'                  => $this->notes,
            'created_by'             => [
                'id'   => $this->createdBy?->id,
                'name' => $this->createdBy?->name,
            ],
            'products'               => StockTransferProductResource::collection($this->whenLoaded('products')),
            'created_at'             => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

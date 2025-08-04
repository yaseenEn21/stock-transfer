<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockTransferProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'product_id'        => $this->product_id,
            'quantity'          => $this->quantity,
            'received_quantity' => $this->received_quantity,
            'damaged_quantity'  => $this->damaged_quantity,
        ];
    }
}

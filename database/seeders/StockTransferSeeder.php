<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockTransfer;
use App\Models\StockTransferProduct;

class StockTransferSeeder extends Seeder {
    public function run() {

        $transfer = StockTransfer::create([
            'delivery_integration_id' => 2,
            'warehouse_from_id' => 1,
            'warehouse_to_id' => 2,
            'status' => 'new',
            'notes' => 'Initial transfer test',
            'created_by' => 1,
        ]);

        StockTransferProduct::create([
            'stock_transfer_id' => $transfer->id,
            'product_id' => 1,
            'quantity' => 10,
            'received_quantity' => null,
            'damaged_quantity' => null,
        ]);

        StockTransferProduct::create([
            'stock_transfer_id' => $transfer->id,
            'product_id' => 2,
            'quantity' => 5,
            'received_quantity' => null,
            'damaged_quantity' => null,
        ]);
    }
}


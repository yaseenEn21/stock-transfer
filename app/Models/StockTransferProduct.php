<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransferProduct extends Model {
    protected $fillable = ['stock_transfer_id','product_id','quantity','received_quantity','damaged_quantity'];

    public function transfer() {
        return $this->belongsTo(StockTransfer::class);
    }
}


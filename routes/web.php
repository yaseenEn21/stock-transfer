<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockTransferController;


Route::get('/', [StockTransferController::class, 'index'])->name('stock_transfers.index');

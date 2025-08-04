<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StockTransferController;
use App\Http\Controllers\Api\WarehouseController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| Routes that do not require authentication
*/
Route::post('login', [AuthController::class, 'login'])->name('api.login');

/*
|--------------------------------------------------------------------------
| Protected Routes (Requires Sanctum Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

    // Stock Transfers
    Route::prefix('stock_transfers')->group(function () {
        Route::get('/index', [StockTransferController::class, 'index']);
        Route::get('/statusFilter', [StockTransferController::class, 'statusFilter']);
        Route::get('/info_details/{transfer}', [StockTransferController::class, 'show']);
        Route::post('/store', [StockTransferController::class, 'store']);
        Route::post('/change_status/{transfer}', [StockTransferController::class, 'changeStatus']);
        Route::post('/cancel_or_return/{transfer}', [StockTransferController::class, 'cancelOrReturn']);
    });

    // Warehouses
    Route::get('warehouses', [WarehouseController::class, 'index'])->name('api.warehouses.index');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('api.products.index');
});

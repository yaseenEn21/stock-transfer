<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_integration_id')->nullable()->constrained('deliveries')->nullOnDelete();
            $table->foreignId('warehouse_from_id')->constrained('warehouses')->cascadeOnDelete();
            $table->foreignId('warehouse_to_id')->constrained('warehouses')->cascadeOnDelete();
            $table->enum('status', ['new','preparing','ready','shipping','received','completed','cancelled','returning'])->default('new');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder {
    public function run() {
        DB::table('warehouses')->insert([
            ['name' => 'Main Warehouse', 'created_at'=>now(),'updated_at'=>now()],
            ['name' => 'Branch Warehouse', 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}


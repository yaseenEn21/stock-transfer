<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    public function run() {
        DB::table('products')->insert([
            ['name' => 'Product A', 'price'=>50, 'created_at'=>now(),'updated_at'=>now()],
            ['name' => 'Product B', 'price'=>100,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}


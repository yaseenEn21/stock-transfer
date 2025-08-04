<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder {
    public function run(): void {
        DB::table('deliveries')->insert([
            ['name' => 'DHL', 'integration_code' => 'dhl', 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'FedEx', 'integration_code' => 'fedex', 'created_at'=>now(), 'updated_at'=>now()],
            ['name' => 'Aramex', 'integration_code' => 'aramex', 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}


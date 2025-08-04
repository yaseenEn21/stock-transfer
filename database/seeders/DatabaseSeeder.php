<?php

namespace Database\Seeders;

use App\Models\Delivery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Yaseen',
        //     'email' => 'admin@test.com',
        //     'password' => bcrypt('123456'),
        // ]);

        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            DeliverySeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            StockTransferSeeder::class,
        ]);
        
    }
}

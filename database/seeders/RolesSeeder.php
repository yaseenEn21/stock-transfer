<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate(['name' => 'sending_warehouse']);
        Role::firstOrCreate(['name' => 'receiving_warehouse']);
        Role::firstOrCreate(['name' => 'shipping_integration']);
    }
}

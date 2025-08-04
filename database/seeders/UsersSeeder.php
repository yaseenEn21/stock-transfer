<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $sendingRole = Role::firstOrCreate(['name' => 'sending_warehouse']);
        $receivingRole = Role::firstOrCreate(['name' => 'receiving_warehouse']);
        $shippingRole = Role::firstOrCreate(['name' => 'shipping_integration']);

        $user1 = User::firstOrCreate([
            'email' => 'sending@example.com',
        ], [
            'name' => 'Sending User',
            'password' => Hash::make('123456'),
        ]);
        $user1->assignRole($sendingRole);

        $user2 = User::firstOrCreate([
            'email' => 'receiving@example.com',
        ], [
            'name' => 'Receiving User',
            'password' => Hash::make('123456'),
        ]);
        $user2->assignRole($receivingRole);

        $user3 = User::firstOrCreate([
            'email' => 'shipping@example.com',
        ], [
            'name' => 'Shipping User',
            'password' => Hash::make('123456'),
        ]);
        $user3->assignRole($shippingRole);
    }
}

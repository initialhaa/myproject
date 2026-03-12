<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'name' => 'Administrator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            [
                'username' => 'customer1',
                'password' => Hash::make('hanafi1'),
                'role' => 'customer',
                'name' => 'hanafi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'customer2',
                'password' => Hash::make('jiun123'),
                'role' => 'customer',
                'name' => 'jiun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'customer3',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'name' => 'Ahmad Hidayat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
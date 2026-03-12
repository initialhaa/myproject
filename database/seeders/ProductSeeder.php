<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['nama_produk' => 'Laptop ASUS ROG', 'harga' => 15000000],
            ['nama_produk' => 'Mouse Logitech', 'harga' => 250000],
            ['nama_produk' => 'Keyboard Mechanical', 'harga' => 500000],
            ['nama_produk' => 'Monitor Samsung 24"', 'harga' => 2000000],
            ['nama_produk' => 'Printer Epson L3110', 'harga' => 3000000],
            ['nama_produk' => 'Flashdisk 32GB', 'harga' => 100000],
            ['nama_produk' => 'Harddisk Eksternal 1TB', 'harga' => 800000],
            ['nama_produk' => 'Webcam Logitech', 'harga' => 350000],
            ['nama_produk' => 'Headset Gaming', 'harga' => 450000],
            ['nama_produk' => 'Speaker Active', 'harga' => 600000],
            ['nama_produk' => 'Mouse Pad', 'harga' => 50000],
            ['nama_produk' => 'Cooling Pad', 'harga' => 150000],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'nama_produk' => $product['nama_produk'],
                'harga' => $product['harga'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
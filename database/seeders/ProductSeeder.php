<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'code' => 'SEM-001',
                'name' => 'Beras Ramos Setra Pulen 5kg',
                'purchase_price' => 65000,
                'selling_price' => 72000,
                'stock' => 50,
                'unit' => 'Sak',
            ],
            [
                'category_id' => 1,
                'code' => 'SEM-002',
                'name' => 'Minyak Goreng Filma 2 Liter',
                'purchase_price' => 34000,
                'selling_price' => 38000,
                'stock' => 40,
                'unit' => 'Pouch',
            ],
            [
                'category_id' => 1,
                'code' => 'SEM-003',
                'name' => 'Gula Pasir Putih 1kg',
                'purchase_price' => 15500,
                'selling_price' => 17500,
                'stock' => 60,
                'unit' => 'Kg',
            ],
            [
                'category_id' => 2,
                'code' => 'BUM-001',
                'name' => 'Kecap Manis Bango 550ml',
                'purchase_price' => 21000,
                'selling_price' => 24000,
                'stock' => 30,
                'unit' => 'Pouch',
            ],
            [
                'category_id' => 2,
                'code' => 'BUM-002',
                'name' => 'Garam Beryodium Cap Kapal 250gr',
                'purchase_price' => 3500,
                'selling_price' => 5000,
                'stock' => 45,
                'unit' => 'Pcs',
            ],
            [
                'category_id' => 3,
                'code' => 'MAK-001',
                'name' => 'Indomie Goreng Original',
                'purchase_price' => 3000,
                'selling_price' => 3500,
                'stock' => 200,
                'unit' => 'Pcs',
            ],
            [
                'category_id' => 3,
                'code' => 'MAK-002',
                'name' => 'Sarden ABC Extra Pedas 425g',
                'purchase_price' => 18000,
                'selling_price' => 21000,
                'stock' => 25,
                'unit' => 'Kaleng',
            ],
            [
                'category_id' => 4,
                'code' => 'SAB-001',
                'name' => 'Deterjen Rinso Anti Noda 800gr',
                'purchase_price' => 19000,
                'selling_price' => 21500,
                'stock' => 35,
                'unit' => 'Pcs',
            ],
            [
                'category_id' => 4,
                'code' => 'SAB-002',
                'name' => 'Sabun Mandi Lux Batang',
                'purchase_price' => 4500,
                'selling_price' => 6000,
                'stock' => 50,
                'unit' => 'Pcs',
            ],
            [
                'category_id' => 5,
                'code' => 'ROK-001',
                'name' => 'Sampoerna Mild 16',
                'purchase_price' => 31000,
                'selling_price' => 33000,
                'stock' => 40,
                'unit' => 'Bungkus',
            ],
            [
                'category_id' => 5,
                'code' => 'ROK-002',
                'name' => 'Djarum Super 12',
                'purchase_price' => 25000,
                'selling_price' => 27000,
                'stock' => 30,
                'unit' => 'Bungkus',
            ],
            [
                'category_id' => 6,
                'code' => 'MIN-001',
                'name' => 'Air Mineral Aqua 600ml',
                'purchase_price' => 3000,
                'selling_price' => 4000,
                'stock' => 60,
                'unit' => 'Botol',
            ],
            [
                'category_id' => 6,
                'code' => 'MIN-002',
                'name' => 'Teh Botol Sosro 450ml',
                'purchase_price' => 4500,
                'selling_price' => 6000,
                'stock' => 45,
                'unit' => 'Botol',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

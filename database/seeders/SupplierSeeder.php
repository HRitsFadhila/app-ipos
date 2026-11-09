<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'CV. Beras Makmur Jaya',
            'phone' => '081234567890',
            'address' => 'Jl. Pasar Besar No. 45, Surabaya',
        ]);

        Supplier::create([
            'name' => 'Distributor Sembako Lancar',
            'phone' => '085678901234',
            'address' => 'Kawasan Industri Margomulyo Blok C-2, Surabaya',
        ]);

        Supplier::create([
            'name' => 'Toko Kelontong Grosir Barokah',
            'phone' => '087890123456',
            'address' => 'Jl. Dupak Rukun No. 12, Surabaya',
        ]);
    }
}

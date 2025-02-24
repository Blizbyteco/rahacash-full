<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SparepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spareparts')->insert([
            ['name' => 'Busi NGK', 'price' => 25000, 'stock' => 50],
            ['name' => 'Oli Mesin Yamalube', 'price' => 45000, 'stock' => 30],
            ['name' => 'Kampas Rem Depan', 'price' => 35000, 'stock' => 40],
            ['name' => 'Kampas Rem Belakang', 'price' => 30000, 'stock' => 40],
            ['name' => 'Aki GS Astra', 'price' => 250000, 'stock' => 20],
            ['name' => 'Ban Luar IRC 70/90-17', 'price' => 180000, 'stock' => 15],
            ['name' => 'Ban Dalam Swallow 70/90-17', 'price' => 50000, 'stock' => 25],
            ['name' => 'Kabel Gas', 'price' => 20000, 'stock' => 35],
            ['name' => 'Kabel Kopling', 'price' => 25000, 'stock' => 30],
            ['name' => 'Kampas Kopling', 'price' => 70000, 'stock' => 20],
            ['name' => 'Saringan Udara', 'price' => 40000, 'stock' => 25],
            ['name' => 'Lampu LED Depan', 'price' => 80000, 'stock' => 15],
            ['name' => 'Bohlam Sein Kanan/Kiri', 'price' => 15000, 'stock' => 50],
            ['name' => 'Rantai & Gir Set', 'price' => 180000, 'stock' => 10],
            ['name' => 'Spion Motor', 'price' => 30000, 'stock' => 20],
            ['name' => 'Tutup Pentil', 'price' => 5000, 'stock' => 100],
            ['name' => 'Stang Motor', 'price' => 120000, 'stock' => 10],
            ['name' => 'Tuas Rem', 'price' => 25000, 'stock' => 30],
            ['name' => 'Bearing Roda', 'price' => 40000, 'stock' => 25],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("barangs")->insert([
            [
                "nama" => "sendok",
                "harga" => 15000,
                "deskripsi" => "sebuah sendok",
                "stok" => 5,
                "kategori" => "Tools"
            ]
        ]);
    }
}

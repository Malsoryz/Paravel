<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Siswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = array(
            [
                "nama"=>"Ikmal",
                "kelas"=>"RPL 2"
            ],
            [
                "nama"=> "aspian",
                "kelas"=>"RPL 2"
            ]
        );
    }
}

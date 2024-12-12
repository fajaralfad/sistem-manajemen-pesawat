<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiPerbaikanSeeder extends Seeder
{
    public function run()
    {
        DB::table('lokasi_perbaikan')->insert([
            ['lokasi' => 'Hangar A'],
            ['lokasi' => 'Hangar B'],
            ['lokasi' => 'Hangar C'],
            ['lokasi' => 'Hangar D'],
            ['lokasi' => 'Hangar E'],
        ]);
    }
}
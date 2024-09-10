<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('scans')->insert([
            ['id_scan' => 1, 'title' => 'Simposium'],
            ['id_scan' => 2, 'title' => 'Workshop 1'],
            ['id_scan' => 3, 'title' => 'Workshop 2'],
            ['id_scan' => 4, 'title' => 'Workshop 3'],
            ['id_scan' => 5, 'title' => 'Workshop 4'],
            ['id_scan' => 8, 'title' => 'Pameran'],
            ['id_scan' => 9, 'title' => 'Snack'],
        ]);
    }
}

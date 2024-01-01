<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TemperatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temperatures')->insert([
            [
                'sale_date' => "2023-12-29",
                'temperature' => 6,
                'weather' => 1,
            ],
            [
                'sale_date' => "2023-12-30",
                'temperature' => 6,
                'weather' => 1,
            ],
            [
                'sale_date' => "2023-12-31",
                'temperature' => 6,
                'weather' => 1,
            ],
            [
                'sale_date' => "2024-01-01",
                'temperature' => 10,
                'weather' => 3,
            ],
            [
                'sale_date' => "2024-01-02",
                'temperature' => 10,
                'weather' => 3,
            ],
            [
                'sale_date' => "2024-01-03",
                'temperature' => 7,
                'weather' => 2,
            ],
        ]);
    }
}

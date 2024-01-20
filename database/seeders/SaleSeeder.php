<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            [
                'user_id' => 1,
                'item_id' => 1,
                'sale_price' => 1000,
                'quantity' => 3,
                'sale_cost' => 420,
                'temperature_id' => 1
            ],
            [
                'user_id' => 1,
                'item_id' => 2,
                'sale_price' => 900,
                'quantity' => 5,
                'sale_cost' => 300,
                'temperature_id' => 2,
            ],
            [
                'user_id' => 1,
                'item_id' => 3,
                'sale_price' => 400,
                'quantity' => 8,
                'sale_cost' => 200,
                'temperature_id' => 2,
            ],
            [
                'user_id' => 1,
                'item_id' => 1,
                'sale_price' => 1000,
                'quantity' => 9,
                'sale_cost' => 420,
                'temperature_id' => 3,
            ],
            [
                'user_id' => 1,
                'item_id' => 3,
                'sale_price' => 400,
                'quantity' => 2,
                'sale_cost' => 200,
                'temperature_id' => 4,
            ],
            [
                'user_id' => 1,
                'item_id' => 1,
                'sale_price' => 2000,
                'quantity' => 2,
                'sale_cost' => 20,
                'temperature_id' => 5,
            ],
            [
                'user_id' => 1,
                'item_id' => 2,
                'sale_price' => 2300,
                'quantity' => 2,
                'sale_cost' => 1000,
                'temperature_id' => 6,
            ],
            [
                'user_id' => 1,
                'item_id' => 5,
                'sale_price' => 1200,
                'quantity' => 2,
                'sale_cost' => 300,
                'temperature_id' => 6,
            ],
        ]);
    }
}

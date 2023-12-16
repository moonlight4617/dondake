<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => 'カット',
                'memo' => 'カットの詳細',
                'price' => 4500,
            ],
            [
                'name' => 'カラー',
                'memo' => 'カラーの詳細',
                'price' => 7000,
            ],
            [
                'name' => 'パーマ',
                'memo' => 'パーマの詳細',
                'price' => 8000,
            ],
        ]);
    }
}

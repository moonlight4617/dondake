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
                'category_id' => '1',
                'name' => '生食パン',
                'price' => 1000,
                'cost' => 420,
                'memo' => 'プレーンタイプの食パン',
            ],
            [
                'category_id' => '1',
                'name' => '山形食パン',
                'price' => 900,
                'cost' => 320,
                'memo' => 'イギリスパン',
            ],
            [
                'category_id' => '3',
                'name' => '抹茶小豆食パン',
                'price' => 900,
                'cost' => 450,
                'memo' => '',
            ],
            [
                'category_id' => '2',
                'name' => '枝豆チーズ食パン',
                'price' => 900,
                'cost' => 380,
                'memo' => '期間限定',
            ],
            [
                'category_id' => '4',
                'name' => 'カレーパン',
                'price' => 300,
                'cost' => 180,
                'memo' => '期間限定',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => '食パン（プレーン）',
            ],
            [
                'name' => '食パン（惣菜系）',
            ],
            [
                'name' => '食パン（デザート系）',
            ],
            [
                'name' => '菓子パン（惣菜系）',
            ],
            [
                'name' => '菓子パン（デザート系）',
            ],
            [
                'name' => 'その他',
            ],
        ]);
    }
}

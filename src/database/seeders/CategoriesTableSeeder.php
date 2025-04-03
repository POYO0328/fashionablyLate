<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $param = [
        'id' => '1',
        'name' => '商品のお届けについて'
    ];
    DB::table('categories')->insert($param);
    $param = [
        'id' => '2',
        'name' => '商品の交換について'
    ];
    DB::table('categories')->insert($param);
    $param = [
        'id' => '3',
        'name' => '商品トラブル'
    ];
    DB::table('categories')->insert($param);
    $param = [
        'id' => '4',
        'name' => 'ショップへのお問い合わせ'
    ];
    DB::table('categories')->insert($param);
    $param = [
        'id' => '5',
        'name' => 'その他'
    ];
    DB::table('categories')->insert($param);
    }
}

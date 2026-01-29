<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
            'content' => '商品のお届けについて',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'id' => '2',
            'content' => '商品の交換について',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'id' => '3',
            'content' => '商品トラブル',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'id' => '4',
            'content' => 'ショップへのお問い合わせ',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('categories')->insert($param);
        $param = [
            'id' => '5',
            'content' => 'その他',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('categories')->insert($param);
    }
}

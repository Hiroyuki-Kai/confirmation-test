<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
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
            'category_id' => '1',
            'first_name' => '山田',
            'last_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '080-1234-5678',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101',
            'detail' => '問合せ',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'id' => '2',
            'category_id' => '2',
            'first_name' => '山田',
            'last_name' => '次郎',
            'gender' => '1',
            'email' => 'atest@example.com',
            'tel' => '080-1234-5679',
            'address' => '東京都新宿区千駄ヶ谷1-2-3',
            'building' => '新宿マンション101',
            'detail' => '問合せ',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'id' => '3',
            'category_id' => '3',
            'first_name' => '山田',
            'last_name' => '花子',
            'gender' => '2',
            'email' => 'btest@example.com',
            'tel' => '080-1234-5656',
            'address' => '東京都江東千駄ヶ谷1-2-3',
            'building' => '江東マンション101',
            'detail' => '問合せ',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'id' => '4',
            'category_id' => '4',
            'first_name' => '山田',
            'last_name' => '三郎',
            'gender' => '3',
            'email' => 'ctest@example.com',
            'tel' => '080-1212-5678',
            'address' => '東京都足立千駄ヶ谷1-2-3',
            'building' => '足立マンション101',
            'detail' => '問合せ',
            'created_at' => '2026-01-28 20:42:15',
            'updated_at' => '2026-01-28 20:42:15'
        ];
        DB::table('contacts')->insert($param);
    }
}

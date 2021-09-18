<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'name1',
            'body' => 'body1',
            'outdoor' => 'なし',
            'indoor' => 'なし',
            'rental' => 'なし',
            'shuttle' => 'なし',
            'prefecture' => '東京都',
            'address' => '渋谷区1-1-1',
            'per_fee' => '3000',
            'charter_fee' => '30000',
            ];
        DB::table('posts')->insert($param);
        
        $param = [
            'name' => 'name2',
            'body' => 'body2',
            'outdoor' => 'あり',
            'indoor' => 'あり',
            'rental' => 'あり',
            'shuttle' => 'あり',
            'prefecture' => '千葉県',
            'address' => '船橋市2-2-2',
            'per_fee' => '5000',
            'charter_fee' => '50000',
            ];
        DB::table('posts')->insert($param);
        
    }
}

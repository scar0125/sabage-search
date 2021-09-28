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
            'name' => 'ASOBIBA秋葉原店 サバイバルゲームフィールド',
            'body' => '東京 千代田区のエアソフトガン用品店',
            'outdoor' => 'なし',
            'indoor' => 'あり',
            'rental' => 'あり',
            'shuttle' => 'なし',
            'prefecture' => '東京都',
            'address' => '千代田区外神田3-1-16',
            'per_fee' => '3500',
            'charter_fee' => '52500',
            ];
        DB::table('posts')->insert($param);
        
        $param = [
            'name' => 'デザートユニオン',
            'body' => '印西市の射撃イベント会場',
            'outdoor' => 'あり',
            'indoor' => 'なし',
            'rental' => 'あり',
            'shuttle' => 'あり',
            'prefecture' => '千葉県',
            'address' => '印西市平賀2853',
            'per_fee' => '2700',
            'charter_fee' => '27000',
            ];
        DB::table('posts')->insert($param);
        
        $param = [
            'name' => 'BLKFOX AIRSOFT FIELD - サバゲーフィールド -',
            'body' => '福生市のスポーツ複合施設',
            'outdoor' => 'なし',
            'indoor' => 'あり',
            'rental' => 'あり',
            'shuttle' => 'なし',
            'prefecture' => '東京都',
            'address' => '福生市福生768',
            'per_fee' => '3500',
            'charter_fee' => '35000',
            ];
        DB::table('posts')->insert($param);
        
    }
}

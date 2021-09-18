<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'post_id' => '1',
            'user_id' => '1',
            'comment' => 'comment1',
            'created_at' => new DateTime(),
            ];
        DB::table('reviews')->insert($param);
    }
}

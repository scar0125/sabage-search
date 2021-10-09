<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'test',
            'email' => 'test@sabage',
            'password' => bcrypt('sabage2021'),
            'email_verified_at' => new DateTime(),
            ];
        DB::table('users')->insert($param);
        
        $param = [
            'name' => 'name2',
            'email' => 'name2@name2',
            'password' => bcrypt('name2name2'),
            ];
        DB::table('users')->insert($param);
    }
}

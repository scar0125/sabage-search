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
            'name' => 'name',
            'email' => 'name@name',
            'password' => bcrypt('namename'),
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

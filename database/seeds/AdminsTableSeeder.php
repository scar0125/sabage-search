<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'admin',
            'email' => 'sabage.search@gmail.com',
            'password' => bcrypt('adminadmin'),
            ];
        DB::table('admins')->insert($param);
    }
}

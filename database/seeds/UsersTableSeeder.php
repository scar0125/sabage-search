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
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds of role_user table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            'role_id' => '3',
            'user_id' => '1',
        ]);
    }
}

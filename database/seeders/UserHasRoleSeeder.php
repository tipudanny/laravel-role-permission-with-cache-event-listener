<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_has_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
        DB::table('user_has_roles')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);
    }
}

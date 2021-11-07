<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_has_permissions')->insert([
            'user_id' => 1,
            'permission_id' => 1
        ]);
        DB::table('user_has_permissions')->insert([
            'user_id' => 2,
            'permission_id' => 2
        ]);
        DB::table('user_has_permissions')->insert([
            'user_id' => 3,
            'permission_id' => 3
        ]);
        DB::table('user_has_permissions')->insert([
            'user_id' => 4,
            'permission_id' => 4
        ]);
    }
}

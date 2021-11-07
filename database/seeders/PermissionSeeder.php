<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'permission' => 'read'
        ]);
        DB::table('permissions')->insert([
            'permission' => 'write'
        ]);
        DB::table('permissions')->insert([
            'permission' => 'edit'
        ]);
        DB::table('permissions')->insert([
            'permission' => 'all'
        ]);
    }
}

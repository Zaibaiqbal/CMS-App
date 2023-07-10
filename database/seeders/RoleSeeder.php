<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = array();

        $count = -1;

        $roles[++$count] = ['name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()];


        $roles[++$count] = ['name' => 'Customer', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()];

        $roles[++$count] = ['name' => 'Employee', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()];

       
        DB::table('roles')->insert($roles);
    }
}

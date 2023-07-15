<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Auth;

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

        $roles[++$count] = ['name' => 'Super Admin', 'guard_name' => 'web', 'added_id' => 1,'created_at' => now(), 'updated_at' => now()];


        $roles[++$count] = ['name' => 'Manager', 'guard_name' => 'web','added_id' => 1,'created_at' => now(), 'updated_at' => now()];
       
        DB::table('roles')->insert($roles);
    }
}

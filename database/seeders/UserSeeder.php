<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // $user = User::create([
        //     'branch_id' => 1,

        //     'name' => "Gis Plus",
        //     'email' => "info@gisplus.net",
        //     'password' => Hash::make("gisplus"),
        //     'cnic' => ("12345-0202020-7"),
        //     'designation' => "Administrator",
        //     'type'=>'Administrator',
        //     'status'=>'Active',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // $role = Role::create(['name' => 'User']);

         $permission = Permission::create(['name' => 'All']);


        //  $role->givePermissionTo($permission);
        //  $permission->assignRole($role);

        //  $user->assignRole('User');
        //  $user->givePermissionTo('All');




         $user1 = User::create([

            'name'          => "Admin",
            'email'         => "admin123@cms.net",
            'password'      => Hash::make("0987654321"),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // $user1->sync(Role::whereIn('name',['Super Admin'])->pluck('id')->toArray());

        // $user1->givePermissionTo('All');

    }
}

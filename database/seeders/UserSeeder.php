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

         $permission = Permission::create(['name' => 'All']);

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

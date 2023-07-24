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

         $user = User::create([

            'name'          => "Admin",
            'email'         => "admin@cms.net",
            'user_type'          => "Super Admin",
            'password'      => Hash::make("0987654321"),
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $role = Role::whereIn('name',['Super Admin'])->first();
        
        $user->syncRoles(Role::whereIn('name',['Super Admin'])->pluck('id')->toArray());

        $role->givePermissionTo($permission);

    }
}

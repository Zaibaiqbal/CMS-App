<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SystemRoles extends Model
{
    use HasFactory;

    public function getModuleWiseDistinctPermissions()
    {
        return Permission::groupby('module','id')->get();
    }

    public function getPermissionByModule($module)
    {
        return Permission::where('module' , $module)->orderby('name','asc')->get();
    }

    public function getDistinctModuleList()
    {
        return Permission::whereNotNull('module')->distinct('module')->get();
    }

    public function getRolesList()
    {
        return Role::distinct('name')->get();
    }

    public function getRoleById($id)
    {
        return Role::where('id',$id)->first();
    }

    public function storeRole($object)
    {
        return DB::transaction(function () use ($object){

            
			$role = Role::create([
				'name' => $object['name'],
				'added_id' => Auth::user()->id
			]);

            return with($role);

        });
    }

    public function updateRole($object)
    {
        return DB::transaction(function () use ($object){

            
			$role = Role::find($object['role_id']);

            if(isset($role->id))
            {
				$role->name = $object['name'];
				$role->added_id = Auth::user()->id;
                $role->update();
			}

            return with($role);

        });
    }

    public function assignPermissionsToRole($object)
    {

        return DB::transaction(function () use ($object){

            $data = ['status' => false , 'message' => ''];

    		$role = new SystemRoles;

    		$role = $role->getRoleById($object['role']);

            if(isset($role->id))
    		{
    			$permission = Permission::find($object['permission']);

    			if(isset($permission->id))
    			{
    				if(!$role->hasPermissionTo($permission))
    				{
    					$role->givePermissionTo($permission);

                        $data = ['status' => true, 'message' => 'Permission granted'];

    				}
    				else
    				{
    					$role->revokePermissionTo($permission);

                        $data = ['status' => false, 'message' => 'Permission revoked'];

    				}
    			}

    		}

    		return with($data);

        });
    }

    public function assignModulePermissions($object)
    {

        return DB::transaction(function () use ($object){

            $data = ['status' => false , 'message' => ''];

    		$role = new SystemRoles;

    		$role = $role->getRoleById($object['role']);

            $flag = $object['flag'];
            if(isset($role->id))
    		{
    			$permission_list = $this->getPermissionByModule($object['module']);

                foreach($permission_list as $rows)
                {
                    if($flag == "true")
                    {
                       if(!$role->hasAnyPermission($rows->id))
                       {
                          $role->givePermissionTo($rows->id);
                        $data = ['status' => true, 'message' => 'Permissions granted'];

                       }
                    }
                    else if($flag == "false")
                    {
                        $role->revokePermissionTo($rows->id);
                        $data = ['status' => false, 'message' => 'Permissions revoked'];


                    }
                }


                $flag = 'true';
            }

    		return with($data);

        });
    }
    

    public function assignRolesToUser($object)
    {

        return DB::transaction(function () use ($object){

            $data = ['status' => false , 'message' => ''];

    		$role = new SystemRoles;
    		$user = new User;

    		$role = $role->getRoleById($object['role_id']);

    		$user = $user->getUserById($object['user_id']);

            if(isset($role->id))
    		{
                    $user->syncRoles($this->getUserRoles($user));

                    $user->assignRole($role);
    
                    return with(true);
               

    		}

    		return with($data);

        });
    }
    

    public function getUserRoles($user)
    {
        return $user->hasAllRoles(Role::get());
    }


    
}

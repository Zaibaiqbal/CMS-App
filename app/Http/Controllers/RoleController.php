<?php

namespace App\Http\Controllers;

use App\Models\SystemRoles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function getValidationList($validation = [])
	{

		return $validation + [

			'name' 	=> 'required|unique:roles|string|min:1|max:50',

		];
	}

	public function index()
	{
		$role_list = Role::get();

		// $role_list = $role->getRoleList();

		return view('roles_and_permissions.manage_roles_permissions',[
			'role_list' => $role_list
		]);
	}

	public function storeRole(Request $request)
	{
        try
        {
            $data = ['status' => false , 'messge' => ''];

            $request->validate($this->getValidationList());
    
            $form_data = $request->input();
    
    
            $role = new SystemRoles;
    
            $role = $role->storeRole($form_data);
    
            if(isset($role->id))
            {
                $data = ['status' => true, 'message' => 'Role created successfully'];
            }
    
            return $data;
        }
        catch(Exception $e)
        {


        }       


	}


	public function updateRole(Request $request)
	{
        try
        {
            if($request->isMethod('post'))
            {
                $data = ['status' => false , 'messge' => ''];

                $request->validate($this->getValidationList()+[
    
                    'role_id'   =>   'required'
    
                ]);
        
                $form_data = $request->input();
                $form_data['role_id']   = decrypt($request->role_id);

        
                $role = new SystemRoles;
        
                $role = $role->updateRole($form_data);
        
                if(isset($role->id))
                {
                    $data = ['status' => true, 'message' => 'Role created successfully'];
                }
        
                return $data;
            }
            else
            {

                $role_id   = decrypt($request->id);
                $role = new SystemRoles;

                $role = $role->getRoleById($role_id);
                return view('roles_and_permissions.modals.update_role',[
                    'role'  => $role
                ]);
            }
        
        }
        catch(Exception $e)
        {


        }       


	}


    public function assignPermissionsToRole(Request $request)
    {
        try
        {
            $data = ['status' => false , 'message' => 'Something went Wrong!'];

            if($request->isMethod('post'))
            {
                // $request->validate($this->getValidationList());
    
                $form_data = $request->input();
                $form_data['role']       = decrypt($form_data['role']);
                $form_data['permission'] = decrypt($form_data['permission']);
                $role = new SystemRoles;
        
                $role = $role->assignPermissionsToRole($form_data);

               
                   return $role;
                
        
            }
            else
            {
                $permission = new SystemRoles;
                $role_id = decrypt($request->id);

                // $permission_list = $permission->getModuleWiseDistinctPermissions();
                $modules = $permission->getDistinctModuleList()->pluck('module')->toArray();
                $role  = $permission->getRoleById($role_id);

                return view('roles_and_permissions.modals.assign_permissions',[
                    'permission' => $permission,
                    'modules' => $modules,
                    'role' => $role,
                ]);
            }
            return $data;
           
        }
        catch(Exception $e)
        {


        }       

    }

    


}

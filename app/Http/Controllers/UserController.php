<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user_list = User::get();
        return view('users.manage_clients',[
            'user_list'  => $user_list
        ]);
    }

    public function viewAllEmployees()
    {
        $user_list = User::get();
        return view('users.manage_employees',[
            'user_list'  => $user_list
        ]);
    }

    public function storeEmployees(Request $request)
    {

        try
        {
            $data = ['status' => false , 'messge' => ''];
            if($request->isMethod('post'))
            {
                $request->validate([

                    'cnic'   => 'required|unique:users,cnic',
                    'name'  =>  'required',
                    'contact_no'  =>  'required',
                    'email'  =>  'required|unique:users,email',
                ]);
                $form_data = $request->input();

                $form_data['user_type'] = 'Employee';
                $user = new User;

                $user = $user->storeUser($form_data);

                if(isset($user->id))
                {
                   $data = ['status' => true , 'message' => 'Employee added successfully'];
                }

                return $data;
            }
            else
            {
                return view('users.modals.add_employee');
            }

        }
        catch(Exception $e)
        {
            
        }
        return redirect()->back();

    }

    public function viewRolesPermissions()
    {
        $user_list = User::get();
        return view('roles_and_permissions.manage_roles_permissions',[
            'user_list'  => $user_list
        ]);
    }

    
}

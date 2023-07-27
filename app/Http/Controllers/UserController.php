<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = new User;
        return view('users.manage_clients',[
            'user_list'  => $user->getUserListByType('Client')

        ]);
    }

    public function viewAllEmployees()
    {
        $user = new User;
        return view('users.manage_employees',[
            'user_list'  => $user->getUserListByType('Employee')
        ]);
    }


    public function viewUnapprovedClients()
    {
        $user = new User;

        $user_list = $user->getUnapproveClients('Client');

        return view('users.view_unapproved_clients',[
            'user_list'  => $user_list
        ]);
    }


    public function autoSearchByClientName(Request $request)
    {

        try
        {

            $data = User::selectRaw("CONCAT(name,' - ',cnic) as client_info , id")
                    ->where('name', 'LIKE', '%'. $request->search. '%')
                    ->where('user_type','Client')
                    ->get();
     
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }

    protected function registerUser(Request $request)
    {

        $request->validate([

            'cnic'      => 'required|unique:users,cnic',
            'name'      =>  'required',
            'contact'   =>  'required|max:13',
            'email'     =>  'required|unique:users,email',
           
        ]);

        $data = $request->input();

        $user = new User;

        $user->name        = $data['name'];
        $user->email       = $data['email'];
        $user->cnic       = $data['cnic'];
        $user->contact       = $data['contact'];

        // $user->password    = $user->generatePassword();
        $user->status    =   'Inactive';
        $user->user_type    =   'Client';
        $user->save();


        $user->assignRole(['Client']);
        if(isset($user->id))
        {
            \Mail::to($user->email)->send(new \App\Mail\RegistrationMail($user));

        
        }

        return redirect()->back()->with('message', 'Email sent successfully!');

    }


    protected function approveUser(Request $request)
    {
        try
        {
            $user_id = decrypt($request->id);

            $user = new User;

            $user  = $user->getUserById($user_id);

            if(isset($user->id) && $user->is_verified == 0 && $user->status == "Inactive")
            {

                $user->is_verified        = 1;
            
                $user->status    =   'Active';

                $user->password    = $this->password_generate(8);
                
                $user->update();
    
                if(isset($user->id) && strlen($user->password) > 0)
                {
                    \Mail::to($user->email)->send(new \App\Mail\ApproveUser($user));
    
                     $user->password    = Hash::make($user->password);
                
                    $user->update();
                }

            }

            return redirect()->back()->with('message', 'User approved! Email sent successfully.');

        }
        catch(Exception $e)
        {

        }


    }

   public function password_generate($chars) 
    {
        $string = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($string), 0, $chars);
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
                    'password'          =>  'nullable|min:8|max:16|same:confirm_password',
                    'confirm_password'  =>  'nullable|min:8|max:16|same:password',
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


    public function storeClient(Request $request)
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
                    // 'password'          =>  'nullable|min:8|max:16|same:confirm_password',
                    // 'confirm_password'  =>  'nullable|min:8|max:16|same:password',
                ]);
                $form_data = $request->input();

                $form_data['user_type'] = 'Client';

                $user = new User;

                $user = $user->storeUser($form_data);

                if(isset($user->id))
                {
                   $data = ['status' => true , 'message' => 'Client added successfully'];

                   
                   if (isset($request->flag)) 
                   {
                       if($request->flag)
                       {
                           $data['name']       = $user->name;
                           $data['id']             = encrypt($user->id);
                           // $data['client_id']      = encrypt($truck->client->id);
                           // $data['name']           = $truck->client->name;
                           $data['contact']        = $user->contact;

                           return $data;
                       }    
                    
                   }
                }

                return $data;
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

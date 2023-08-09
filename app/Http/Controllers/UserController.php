<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function viewUnapprovedContactPersons()
    {
        $user = new User;

        $user_list = $user->getUnapproveContactPersons('Contact Person');

        return view('users.view_unapproved_contact_persons',[
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


    public function approveUser(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {

                $form_data = $request->input();

                $request->validate([
    
                    'user'                  => 'required',
                    'account_no'              => 'required|max:15|min:0|unique:accounts',
                    // 'title'                   => 'required|max:255|min:0',
                   
                    ]);

                $user_id = decrypt($request->user);

                $user = new User;

                $user  = $user->getUserById($user_id);

                if(isset($user->id) && $user->is_verified == 0 && $user->status == "Inactive")
                {
                    if(isset($form_data['account_no']))
                    {
                        $account = new Account;

                        $account = $account->storeAccount($form_data);

                        if(isset($account->id))
                        {
                            $object['user_id']   =  $user->id;
                            $object['account_id']   =  $account->id;
                            
                            $user_account = new UserAccount;

                            $user_account = $user_account->storeUserAccount($object);
                        }


                    }

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

                if(isset($user->id))
                {
                    $data = ['status' => true, 'message' => 'User approved! Email sent successfully.'];
                }
        
                return $data;

            }
            else
            {
                $user_id = decrypt($request->id);

                $user = new User;

                $user  = $user->getUserById($user_id);

                if(isset($user->id) && $user->is_verified == 0 && $user->status == "Inactive")
                {

                    return view('users.modals.approve_client',[
                        'user'  =>  $user
                    ])->render();
                }

            }

        }
        catch(Exception $e)
        {

        }


    }

    public function approveContactPerson(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {

                $form_data = $request->input();

                $request->validate([
    
                    'user_account'                      => 'required',
                    'account_no'                 => 'required|max:15|min:0',
                    // 'title'                   => 'required|max:255|min:0',
                   
                    ]);

                $user_account = decrypt($request->user_account);

                $user = new UserAccount;

                $user_account  = $user->getUserAccountById($user_account);

                $user = $user_account->user;

                if(isset($user->id) && $user->is_verified == 0 && $user->status == "Inactive")
                {
                    if(isset($form_data['account_no']))
                    {
                        $account = new Account;

                        $account = $account->storeAccount($form_data);

                        if(isset($account->id))
                        {
                            $object['user_id']      =  $user->id;
                            $object['account_id']   =  $account->id;
                            $object['id']           =  $user_account->id;
                            
                            $user_account = new UserAccount;

                            $user_account = $user_account->updateUserAccount($object);
                        }


                    }

                    $user->is_verified        = 1;
                
                    $user->status    =   'Active';

                    $user->password    = $this->password_generate(8);
                    
                    $user->update();

        
                    if(isset($user->id) && strlen($user->password) > 0)
                    {
                        \Mail::to($user->email)->send(new \App\Mail\ApproveUser($user));
        
                        $user->password    = Hash::make($user->password);
                    
                        $user->update();

                        $user->assignRole(['Contact Person']);

                    }

                }

                if(isset($user->id))
                {
                    $data = ['status' => true, 'message' => 'User approved! Email sent successfully.'];
                }
        
                return $data;

            }
            else
            {
                $user_account_id = decrypt($request->id);

                $user = new UserAccount;

                $user_account  = $user->getUserAccountById($user_account_id);

                if(isset($user_account->id))
                {

                    return view('users.modals.approve_contact_person',[

                        'user_account'  =>  $user_account
                    
                    ])->render();
                }

            }

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

    public function changePassword(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

                $request->validate([
                
                    'old_password' => [
                        'required', function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('Old password didn\'t match');
                            }
                        },
                    ],
    
                    'new_password' => ['required', 'string', 'min:8','max:16','same:confirm_password'],
    
                    'confirm_password' => ['required', 'string', 'min:8','max:16','same:new_password'],

                ]);
                $form_data = $request->input();

                $user = User::find(Auth::user()->id);

                $user->password       = Hash::make(trim($request->new_password));
    
                $user->update();
    
    
                return ['status' => true, 'message' => 'Password has updated successfully.'];

            }
          
        
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
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
                           $data['id']             = $user->id;
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

    public function getContactPersonList()
    {
        try
        {
            $user_account = new UserAccount;
            $user_list = $user_account->getContactPersonListByClientId();

            return view('clients.contact_persons.manage_contact_persons',[
                'user_list'   =>  $user_list
            ]);
        }
        catch(Exception $e)
        {

        }
    }

    public function requestContactPerson(Request $request)
    {
        try
        {
            $data = ['status' => false , 'messge' => ''];

            if($request->isMethod('post'))
            {

                $request->validate([

                    'name'      =>  'required',
                    'contact_no'   =>  'required|max:13',
                    'email'     =>  'required|unique:users,email',
                    'account_type'     =>  'required',
                   
                ]);
                $form_data = $request->input();
                $form_data['user_type']  = 'Contact Person';
        
                $user = new User;
                $user = $user->storeUser($form_data);

                if(isset($user))
                {
                    $object['user_id']  = $user->id;
                    $object['parent_id']  = Auth::user()->id;

                    $user_account = new UserAccount;
                    $user_account = $user_account->storeUserAccount($object);
                
                    $data = ['status' => true , 'message' => 'Request Generated Successfully'];

                }

                return $data;

            }
            else
            {

                return view('clients.contact_persons.modals.add_request_contact_person')->render();

            }

        }
        catch(Exception $e)
        {

        }
        return redirect()->back();
    }


    
}

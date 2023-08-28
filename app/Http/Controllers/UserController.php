<?php

namespace App\Http\Controllers;

use App\Events\SendNotification;
use App\Models\Account;
use App\Models\MaterialRate;
use App\Models\Truck;
use App\Models\User;
use App\Models\UserAccount;
use Exception;
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

        $user_list = $user->getContactPersonsByCondition('Contact Person','Inactive',0);
// dd($user_list);
        return view('users.view_unapproved_contact_persons',[
            'user_list'  => $user_list
        ]);
    }

    public function viewContactPersons()
    {
        $user = new User;

        $user_list = $user->getContactPersonsByCondition('Contact Person','Active',1);

        return view('users.view_approved_contact_persons',[
            'user_list'  => $user_list
        ]);
    }


    public function registerUser(Request $request)
    {

       $request->validate([

            'name'      =>  'required|max:255|min:0',
            'contact'   =>  'required|max:13',
            'email'     =>  'required|email|unique:users,email',
           
        ]);

        $data = $request->input();

        $user = new User;
        $user = $user->registerUser($data);

        if(isset($user->id))
        {
            $data = ['status' => true, 'message' => 'User Registered. Email sent successfully.','redirect_url' => route('login')];

        }
    
        return $data;

    }

    
    public function approveRequestToDeactiveUser(Request $request)
    {
        try
        {

                $user_id = decrypt($request->id);

                $user = new User;

                $user  = $user->getUserById($user_id);

                if(isset($user->id) && $user->is_verified == 1 && $user->status == "Inactive")
                {

 
                    $user->is_verified        = 0;
                
                    $user->update();
                    $user_account = new UserAccount;
                    $user_account = $user_account->deactivateAccount($user); 


                }


                return redirect('contactpersons')->with('message', 'User Deactivated successfully!');


        }
        catch(Exception $e)
        {

        }


    }

    public function approveUser(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {

                $form_data = $request->input();

                $request->validate([
    
                    'user'                      => 'required',
                    'account_no'                => 'required|max:15|min:0|unique:accounts',
                    'title'                     => 'required|max:255|min:0',
                    'client_group'              => 'required',
                   
                    ]);

                $user_id = decrypt($request->user);

                $user = new User;

                $user  = $user->getUserById($user_id);
                // dd($user);

                if(isset($user->id) && $user->is_verified == 0 && $user->status == "Inactive")
                {
                    if(isset($form_data['account_no']))
                    {
                        $account = new Account;
                        $form_data['status']  = 'Active';
                        $form_data['approval_status']  = 'Approved';
                        $form_data['user_id']  = $user->id;
// dd($form_data);
                        $account = $account->storeAccount($form_data);

                        if(isset($account->id))
                        {
                            $object['user_id']      =  $user->id;
                            $object['account_id']   =  $account->id;
                            $object['status']       =  'Approved';
                            
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
                        $user->client_group   = $form_data['client_group'];
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
                    'title'                   => 'required|max:255|min:0',
                    'client_group'                   => 'required',
                   
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

                        if($user->account_type == "New Account")
                        {
                            $form_data['user_id']  =   $user->client->id;

                            $account = $account->storeAccount($form_data);
                        }
                        else
                        {

                            $account = $account->getAccountByAccountNo($form_data['account_no']);

                        }
                        // dd($account);
                        if(isset($account->id))
                        {
                            $object['user_id']      =  $user->id;
                            $object['account_id']   =  $account->id;
                            $object['id']           =  $user_account->id;
                            $object['title']           =  $form_data['title'];
                            $object['status']           =  'Approved';
                            
                            $user_account = new UserAccount;

                            $user_account = $user_account->updateUserAccount($object);
                        }


                    }
// exit;
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
// dd($user_account);
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

                    // 'cnic'   => 'required|unique:users,cnic',
                    'name'  =>  'required',
                    'contact_no'  =>  'required',
                    'email'  =>  'required|unique:users,email',
                    'password'          =>  'nullable|min:8|max:16|same:confirm_password',
                    'confirm_password'  =>  'nullable|min:8|max:16|same:password',
                ]);
                $form_data = $request->input();

                $form_data['user_type'] = 'Employee';
                $form_data['status'] = 'Active';
                $form_data['is_verified'] = 1;

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

    public function updateEmployee(Request $request)
    {

        try
        {
            $data = ['status' => false , 'messge' => ''];
            if($request->isMethod('post'))
            {
                $user_id = decrypt($request->employee);
                $request->validate([

                    // 'cnic'   => 'required|unique:users,cnic',
                    'name'  =>  'required',
                    'employee'  =>  'required',
                    
                    'contact_no'  =>  'required',
                    'email'         =>  'required|unique:users,email,'.$user_id,
                    'password'          =>  'nullable|min:8|max:16|same:confirm_password',
                    'confirm_password'  =>  'nullable|min:8|max:16|same:password',
                ]);
                $form_data = $request->input();

                // $form_data['user_type'] = 'Employee';
                // $form_data['status'] = 'Active';
                $form_data['user_id'] = decrypt($form_data['employee']);
                $user = new User;

                $user = $user->updateUser($form_data);

                if(isset($user->id))
                {
                   $data = ['status' => true , 'message' => 'Employee added successfully'];
                }

                return $data;
            }
            else
            {
                $id = decrypt($request->id);

                $user = new User;
                $user = $user->getUserById($id);
                return view('users.modals.update_employee',[
                    'user'  => $user
                ]);
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
            $user_list = $user_account->getUserAccountListByClientId(Auth::user()->id);
// dd($user_list);
            return view('clients.contact_persons.manage_contact_persons',[
                'user_list'   =>  $user_list
            ]);
        }
        catch(Exception $e)
        {

        }
    }

    public function viewDeactiveUsers(Request $request)
    {
        try
        {
            
            $user = new User;

            $user_list = $user->getDeactiveUserList('Contact Person',decrypt($request->id));

            return view('users.view_deactive_users',[
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
                $validation = [];

                if($request->account_type == "Existing Account")
                {
                    $validation = [
                        'account_no.*'  => 'required'
                    ];
                }
               

                $request->validate($validation+[

                    'name'      =>  'required',
                    'contact_no'   =>  'required|max:13',
                    'email'     =>  'required|unique:users,email',
                    'account_type'     =>  'required',
                   
                ]);
                $form_data = $request->input();
                
                $form_data['user_type']  = 'Contact Person';

                if(isset($form_data['account']) && @count($form_data['account']) > 0)
                {
                    foreach($form_data['account'] as $key => $rows)
                    {
                        $form_data['account'][$key]    =  decrypt($rows);

                    }
                }
        // dd($form_data);
                $user = new User;
                $user = $user->storeUser($form_data);

                if(isset($user->id))
                {
                    $data = ['status' => true , 'message' => 'Request Generated Successfully'];

                }
                

                return $data;

            }
            else
            {
                $account = new Account;
                $account_list = $account->getAccountListByCondition(['added_id' => Auth::user()->id,'approval_status' => 'Approved']);

// dd($account_list);
                return view('clients.contact_persons.modals.add_request_contact_person',[
                    'account_list'    =>   $account_list
                ])->render();

            }

        }
        catch(Exception $e)
        {

        }
        return redirect()->back();
    }


    public function deactiveUser(Request $request)
    {
        try
        {
            $data = ['status' => false , 'messge' => ''];

    
                $user_id = decrypt($request->id);

                $user = new User;
                $user = $user->deactiveUser($user_id);

                return redirect()->back()->with('message', 'Request sent successfully!');



        }
        catch(Exception $e)
        {

        }
        return redirect()->back();
    }

    public function viewClientSummary(Request $request)
    {
        try
        {
            $client_id = decrypt($request->id);

            $user = new User;
            $account = new Account;
            $truck = new Truck;
            $material_rates = new MaterialRate;
            $user = $user->getUserById($client_id);

            $contact_list = $user->getUserListByCondition(['client_id' => $client_id]);

            $account_list = $account->getAccountListByCondition(['added_id' => $client_id]);

            $truck_list = $truck->getClientTrucks($client_id);
            $material_rates_list = $material_rates->getMaterialRatesByAccount($client_id);

            return view('users.view_client_summary',[
                'user'              =>     $user,
                'contact_list'      =>  $contact_list,
                'account_list'      =>  $account_list,
                'trucks_list'        =>  $truck_list,
                'material_rates_list'        =>  $material_rates_list,
            ]);

        }
        catch(Exception $e)
        {

        }
    }

    
}

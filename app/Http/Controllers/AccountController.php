<?php

namespace App\Http\Controllers;

use App\Events\SendNotification;
use App\Models\Account;
use App\Models\User;
use App\Models\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {

        $accounts_list = Account::get();
        return view('accounts.manage_accounts',[
            'accounts_list'  =>  $accounts_list
        ]);
    }


    public function assignAccountList()
    {

        $account = new UserAccount;

        return view('clients.client_accounts.manage_account_assignment',[
            
            'accounts_list'  =>  $account->getAllAssignAccountListByClientId(Auth::user()->id)
        ]);
    }


    public function viewUnapprovedAccountAssignment(Request $request)
    {

        $user = new UserAccount;

        $user_list = $user->getUnapprovedAccountAssignments(decrypt($request->id));

        return view('accounts.view_unapproved_accountsassignment',[
            'user_list'  => $user_list
        ]);
    }

    public function getAccountInfo(Request $request)
    {

        $data = [];
        $account = new Account;
        $account = $account->getAccountById(decrypt($request->account));

        // dd($account);
        if(isset($account->id))
        {
           $data['client_group']  =  $account->user->client_group;

        }
        return $data;
    }

    public function assignAccount(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {

                $form_data = $request->input();

                $form_data['user_id']   = $form_data['user'];
                $form_data['account_id']   = $form_data['account'];
                $user_account = new UserAccount; 
                $user_account = $user_account->storeUserAccount($form_data);
                if(isset($user_account->id))
                {
                    $user = new User;
                    $user_ids = $user->getUserIdsByPermissions(['All']);
    
                    $client = $user->getUserById(Auth::user()->id);
    
                    event(new SendNotification($client->id,$user_ids,'','unapprovedaccounts',$user_account->user_id,$client->name. ' has requested to assign new account to ' .$user_account->user->name));
    
                    $data = ['status' => true, 'message' => 'Account requested successfully'];
                }

                return $data;

            }
            else
            {
                $user = new User;
                $user_list = $user->getUserListByCondition(['client_id' => Auth::user()->id,'user_type' => 'Contact Person']);

                $account = new Account;
                $account_list = $account->getAccountListByCondition(['added_id' => Auth::user()->id,'approval_status' => 'Approved']);

                return view('clients.client_accounts.modals.assign_account',[

                    'user_list'    =>   $user_list,
                    'account_list'    =>   $account_list,
                
                    ]);
            }

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
    }

    public function approveAccount(Request $request)
    {
        $account_id = $request->id;

        $account = new Account;
        $account = $account->getAccountById($account_id);

        if(isset($account->id))
        {
            $account->approval_status = 'Approved';
            $account->status = 'Active';
            $account->update();

            // return ['status' => true, 'message' => 'Account added successfully'];

        }
        return redirect()->back()->with('Account approved successfully');

    }

    public function clientAccountList()
    {

        $account = new UserAccount;

        return view('clients.client_accounts.manage_client_accounts',[
            
            'accounts_list'  =>  $account->getAllAccountListByClientId(Auth::user()->id)
        ]);
    }

    public function viewAccountRequests()
    {

        $account = new Account;

        return view('accounts.manage_accounts',[
            
            'accounts_list'  =>  $account->getRequestedAccountList()
        ]);
    }

    
    public function storeAccount(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {
                $validation = [];
                if(Auth::user()->hasRole(['Super Admin'])){
    
                    $validation += [
                        'client'      =>    'required'
                    ];
                }
               $request->validate($validation+[
    
                    // 'client_group'                  => 'required',
                    'account_no'              => 'required|unique:accounts,account_no',
                    'title'                   => 'required',
                   
    
                    ]);

                    $form_data = $request->input();
                    if(Auth::user()->hasRole(['Super Admin'])){

                        $form_data['user_id']           = decrypt($form_data['client']);
                        $form_data['approval_status']   = 'Approved';
                        $form_data['status']            = 'Active';
    
                    }
                    // dd($form_data);
    
                    $account = new Account;

                   $account = $account->storeAccount($form_data);

                    // $account->title = $form_data['title'];
                    // $account->account_number = $form_data['account_no'];
                    // $account->client_id = decrypt($form_data['client']);
                    // $account->status = 'Active';
    
                    // $account->save();
    
                    if(isset($account->id))
                    {
                        if(!Auth::user()->hasRole(['Super Admin'])){
  

                            $user = new User;
                            $user_ids = $user->getUserIdsByPermissions(['All']);
            
                            $client = $user->getUserById(Auth::user()->id);
            
                            event(new SendNotification($client->id,$user_ids,'','accountrequests',$account->id,$client->name. ' has requested to add a new account ' .$account->title.'-'.$account->account_no));
            
                        }
                      
                        $data = ['status' => true, 'message' => 'Account added successfully'];

                        return $data;
    
                    }
               
            }
            else
            {
                $user = new User;
                $client_list = $user->getUserListByType('Client');

                return view('accounts.modals.add_account',[

                    'client_list'   =>   $client_list

                ]);
            }


        }
        catch(Exception $e)
        {

        }

      

    }

}

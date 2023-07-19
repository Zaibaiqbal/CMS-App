<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {

        $accounts_list = Account::get();
        return view('accounts.manage_accounts',[
            'accounts_list'  =>  $accounts_list
        ]);
    }

    public function storeAccount(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {

                $data = ['status' => false, 'message' => ''];
        
                $request->validate([
    
                    'client'                  => 'required',
                    'account_no'              => 'required|max:15|min:0',
                    'title'                   => 'required|max:255|min:0',
                   
    
                    ]);
                    $form_data = $request->input();
    
                    $account = new Account;
                    $account->title = $form_data['title'];
                    $account->account_number = $form_data['account_no'];
                    $account->client_id = decrypt($form_data['client']);
                    $account->status = 'Active';
    
                    $account->save();
    
                    if(isset($account->id))
                    {
                        $data = ['status' => true, 'message' => 'Account added successfully'];
    
                    }
               
                return $data;
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

        return redirect()->back();
      

    }

}

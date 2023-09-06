<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\UserAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ImportController extends Controller
{

    private $call_back;
    private $code;
 





    public function __construct()
    {
        $this->call_back['message']     = 'Something is wrong';
        $this->call_back['status']      = 'error';
        $this->code                     =  403;

    }

    public function getValidationList($validation = [])
    {
        return $validation + [

            'file'        =>  'required|mimes:csv,txt|max:2000',
        ];
    }


    public function importClientData(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->all(),$this->getValidationList());
                
                if($validator->fails())
                {
                    $this->setErrorMessage(422,'error',$validator->errors()->first());
                }

                DB::transaction(function() use ($request) {
        
        
                    $path = $request->file('file')->getRealPath();
        
                    if($request->has('header')) 
                    {
                        $data = Excel::load($path, function($reader) {})->get()->toArray();
                    }
                    else 
                    {
                        $data = array_map('str_getcsv', file($path));
                    }
        
                
                    unset($data[0]);
                    
                    $user_info = [];
        
                    foreach($data as $key => $rows)
                    {
                        // dd($data[5]);
                        $user = new User;
        
                        if(strlen(trim($rows[0])) > 0)
                        {

                            $user_info['user_type']              = 'Client';

                            $user_info['name']         = $rows[1];
                      
                            $user_info['email']             = trim($rows[6]);
                            $user_info['password']          = NULL;
                    
                            $user_info['client_group']           = $rows[3];

                            $user_info['contact_no']           = $rows[4];
                            $user_info['other_contact']     = $rows[5];
                    
                            $user_info['address'] = $rows[7];
                            $user_info['city'] = $rows[8];
                            $user_info['province'] = $rows[9];
                            $user_info['postal_code']        = $rows[10];
                            $user_info['is_verified']        = 1;
                            $user_info['status']            = 'Active';
                  
                            $user =   $user->storeUser($user_info);

                            if(isset($user->id) && strlen($rows[2]) > 0)
                            {
                                $account_info = [];

                                $account_info['account_no']         = $rows[2];
                                $account_info['title']              = $user->name;
                                $account_info['user_id']            = $user->id;
                                $account_info['approval_status']    = 'Approved';
                                $account_info['status']             = 'Active';

                                $account = new Account;
                                $account = $account->storeAccount($account_info);


                                if(isset($account->id))
                                {
                                    $user_account = [];

                                    $account_info['account_id']              = $account->id;
                                    $user_account['user_id']            = $account->user_id;
                                    $user_account['status']            = 'Active';
                                    
                                    $user_account = new UserAccount;
                                    $user_account = $user_account->storeUserAccount($account_info);
                                }

                            }

                        //  dd($user);
                        }  

                    }            
        
                    
                    
                    return $this->setErrorMessage(200,'success','Csv succssfully uploaded');
                });
             
    
            }
            else
            {
                return view('data-import.modals.client_import')->render();
    
            }
        }
        catch(Exception $e)
        {
            dd($e);
        }
     
    }
    public function setErrorMessage($code,$status,$msg)
    {
        $this->call_back['message']   = $msg;
        $this->call_back['status']    = $status;
        $this->code                   = $code;
    }

}

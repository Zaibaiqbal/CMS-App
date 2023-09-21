<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Truck;
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
       
            if($request->isMethod('post'))
            {
                $request->validate($this->getValidationList());

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
                      
                            $user_info['email']             = trim($rows[5]);
                            $user_info['password']          = NULL;
                    
                            $user_info['client_group']           = $rows[2];

                            $user_info['contact_no']           = $rows[3];
                            $user_info['other_contact']     = $rows[4];
                    
                            $user_info['address'] = $rows[6];
                            $user_info['city'] = $rows[7];
                            $user_info['province'] = $rows[8];
                            $user_info['postal_code']        = $rows[9];
                            $user_info['is_verified']        = 1;
                            $user_info['status']            = 'Active';
                  
                            $user =   $user->storeUser($user_info);

                        //  dd($user);
                        }  

                    }            
        

                });
                return $data = ['status' => true,'message' => 'Csv uploaded successfully'];
             
    
            }
            else
            {
                return view('data-import.modals.client_import')->render();
    
            }
      
    }

    public function importAccountsData(Request $request)
    {
        if($request->isMethod('post'))
            {
                $request->validate($this->getValidationList());

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
        
                        if(strlen(trim($rows[1])) > 0)
                        {
                            $user = new User;

                            $user = $user->getUserByName(trim($rows[1]));

                            if(isset($user->id))
                            {

                                $account = new Account;

                                $account = $account->getAccountByName(trim($rows[2]));

                                if(isset($account->id))
                                {
                                    $user_account = [];

                                    $account_info['account_id']              = $account->id;
                                    $account_info['user_id']                 = $user->id;
                                    $account_info['status']                  = 'Active';
                                        
                                    $user_account = new UserAccount;
                                    $user_account = $user_account->storeUserAccount($account_info);
                                }
                                else
                                {
                                    $account = new Account;
                                    $account->account_no        =   $rows[3];
                                    $account->title             =   $rows[2];
                                    $account->added_id          =   $user->id;

                                    $account->approval_status    = 'Approved';
                                    $account->status            = 'Active';

                                    $account->save();
    
                                    $user_account = [];

                                    $account_info['account_id']              = $account->id;
                                    $account_info['user_id']                 = $user->id;
                                    $account_info['status']                  = 'Active';
                                        
                                    $user_account = new UserAccount;
                                    $user_account = $user_account->storeUserAccount($account_info);
                                }

                            }

                        //  dd($user);
                        }  

                    }            
        
                });
             
                return $data = ['status' => true,'message' => 'Csv uploaded successfully'];
    
            }
            else
            {
                return view('data-import.modals.accounts_import')->render();
    
            }
    
     
    }

    public function importTrucksData(Request $request)
    {
        try
        {
            $data = ['status' => false,'message' => ''];

        if($request->isMethod('post'))
            {
                $request->validate($this->getValidationList());

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
        
                        if(strlen(trim($rows[1])) > 0)
                        {
                            $account = new Account;

                            $account = $account->getAccountByAccountNo(trim($rows[2]));

                            if(isset($account->id))
                            {
                                $user = $account->user;

                                $truck = new Truck;

                                $truck = $truck->getTruckByPlateNo(trim($rows[1]));

                                if(isset($truck->id) && $truck->user->id == $user->id)
                                {
                                    // dd("truck exist already ", $truck->plate_no .'-'.$user->name);
                                    continue;
                                 
                                }
                                else
                                {
                                    $truck = new Truck;

                                    $truck->plate_no            =   trim($rows[1]);
                                    $truck->client_id            =   $user->id;

                                    // $truck->identifier          = trim($rows[2]).'-'.$user->name;

                                    $truck->save();
    
                                }

                            }
                            else
                            {
                                // dd("account doesnot exist".$rows[2]);
                            continue;
                            }

                        //  dd($user);
                        }  

                    }            
        
                });
             
                return $data = ['status' => true,'message' => 'Csv uploaded successfully'];
    
            }
            else
            {
                return view('data-import.modals.trucks_import')->render();
    
            }
            return $data;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    use HasFactory;

    public function getAccountByAccountNo($account_no)
    {
        
        return Account::where('is_deleted',0)->where('account_no',$account_no)->first();
    }

    public function getAccountByName($title_name)
    {
        
        return Account::where('is_deleted',0)->where('title', 'LIKE', '%'. $title_name. '%')->first();
    }

    
    public function getRequestedAccountList()
    {
        
        return Account::where('is_deleted',0)->where('approval_status','Unapproved')->get();
    }

    public function getAccountListByCondition($condition = [])
    {
        
        return Account::where('is_deleted',0)->where($condition)->orderby('id','asc')->get();
    }

    public function getAccountById($id)
    {
        return Account::where('is_deleted',0)->where('id',$id)->first();

    }

    public function user()
    {
        return $this->belongsTo(User::class,'added_id')->withDefault();
    }

    public function storeAccount($object)
    {
        return DB::transaction(function() use ($object){

            $account = new Account;
            $account->account_no = $object['account_no'];
            
            if(isset($object['title']))
            {
                $account->title = $object['title'];

            }

            // if(isset($object['client_group']))
            // {
            //     $account->client_group = $object['client_group'];

            // }

            if(isset($object['approval_status']))
            {
                $account->approval_status = $object['approval_status'];

            }

            if(isset($object['status']))
            {
                $account->status = $object['status'];

            }
            // dd($object);
            if(isset($object['user_id']))
            {
                $account->added_id = $object['user_id'];

            }
            else
            {
                $account->added_id = Auth::user()->id;
                
            }
            $account->save();

            if(Auth::user()->hasRole(['Super Admin']))
            {
                // dd($account->id);
            
                $user_account_info = [

                    'account_id'    =>   $account->id,
                    'user_id'       =>   $account->added_id,
                    'status'        =>   'Active'
                ];
// dd($user_account);
                $user_account = new UserAccount;
                $user_account = $user_account->storeUserAccount($user_account_info);

            }
            
            return with($account);

        });
    }

}

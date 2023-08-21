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


    public function getRequestedAccountList()
    {
        
        return Account::where('is_deleted',0)->where('approval_status','Requested')->get();
    }

    public function getAccountById($id)
    {
        return Account::where('is_deleted',0)->where('id',$id)->first();

    }

    public function user()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
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

            if(isset($object['client_group']))
            {
                $account->client_group = $object['client_group'];

            }

            if(isset($object['approval_statis']))
            {
                $account->approval_statis = $object['approval_statis'];

            }

            if(isset($object['status']))
            {
                $account->status = $object['status'];

            }
            $account->added_id = Auth::user()->id;

            $account->save();
            
            return with($account);

        });
    }

}

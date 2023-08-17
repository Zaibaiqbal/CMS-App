<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model
{
    use HasFactory;

    public function getAccountByAccountNo($account_no)
    {
        return Account::where('is_deleted',0)->where('account_no',$account_no)->first();
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

            $account->save();
            
            return with($account);

        });
    }

}

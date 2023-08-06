<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserAccount extends Model
{
    use HasFactory;


    public function storeUserAccount($object)
    {
        return DB::transaction(function() use ($object){

            $user_account = new UserAccount;
            $user_account->client_id = $object['client_id'];
            $user_account->account_id = $object['account_id'];

            $user_account->save();
            
            return with($user_account);

        });
    }
}

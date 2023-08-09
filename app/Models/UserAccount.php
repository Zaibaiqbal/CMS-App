<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class UserAccount extends Model
{
    use HasFactory;

    public function getUserAccountById($id)
    {
        return UserAccount::where('is_deleted',0)->where('id',$id)->first();

    }

    public function getContactPersonListByClientId()
    {
        return UserAccount::where('is_deleted',0)->where('parent_id',Auth::user()->id)->get();
    }

    public function getAccountById($id)
    {
        return Account::where('is_deleted',0)->where('id',$id)->first();
    }


    public function storeUserAccount($object)
    {
        return DB::transaction(function() use ($object){

            $user_account = new UserAccount;

            $user_account->user_id = $object['user_id'];

            if(isset($object['parent_id']))
            {
                $user_account->parent_id = $object['parent_id'];
            }

            if(isset($object['account_id']))
            {
                $user_account->account_id = $object['account_id'];

            }

            $user_account->save();
            
            return with($user_account);

        });
    }

    public function updateUserAccount($object)
    {
        return DB::transaction(function() use ($object){

            $user_account = UserAccount::find($object['id']);

            if(isset($user_account->id))
            {

                 $user_account->account_id = $object['account_id'];

                 $user_account->update();


            }

            
            return with($user_account);

        });
    }


    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }

    public function account()
    {
        return $this->belongsTo(Account::class,'account_id')->withDefault();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }



}

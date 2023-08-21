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

    public function getClientByUserId($id)
    {
        return UserAccount::where('is_deleted',0)->where('user_id',$id)->first();

    }
    
    public function getUserAccountListByClientId($id)
    {
        return UserAccount::where('is_deleted',0)->where('account_id','>',0)->where('parent_id',$id)->orWhere('user_id',$id)->get();
    }

    public function getAccountListByClientId($id)
    {
        return UserAccount::join('users', 'user_accounts.user_id', '=', 'users.id')
        ->join('accounts', 'user_accounts.account_id', '=', 'accounts.id')
        ->where('user_accounts.is_deleted',0)
        ->where('user_accounts.parent_id', '=', $id)
        ->orWhere('user_accounts.user_id',$id)
        ->select('accounts.id', 'accounts.account_no','accounts.title')
        ->distinct('accounts.account_no')
        ->get();
    }


    public function getAllAccountListByClientId($id)
    {
        return UserAccount::join('users', 'user_accounts.user_id', '=', 'users.id')
        ->join('accounts', 'user_accounts.account_id', '=', 'accounts.id')
        ->where('user_accounts.is_deleted',0)
        ->where('user_accounts.parent_id', '=', $id)

        ->orWhere('user_accounts.user_id',$id)
        ->select('accounts.id', 'accounts.account_no','accounts.title','accounts.status','accounts.client_group')
        ->distinct('accounts.account_no')

        ->get();
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
            if(isset($object['status']))
            {
                $user_account->status = $object['status'];

            }

            if(isset($object['description']))
            {
                $user_account->description = $object['description'];

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
                 $user_account->status = $object['status'];
                //  $user_account->title = $object['title'];

                 $user_account->update();


            }

            
            return with($user_account);

        });
    }

    public function deactivateAccount($user)
    {
        return DB::transaction(function() use ($user){


            $user_account = $this->getClientByUserId($user->id); // here this method is used for finding contact person
            if(isset($user_account->id))
            {

                 $user_account->is_deleted = 1;

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

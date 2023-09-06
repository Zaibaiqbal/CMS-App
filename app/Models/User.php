<?php

namespace App\Models;

use App\Events\SendNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function searchableAs()
    // {
    //     return 'users';
    // }

    public function getUserById($id)
    {
        return User::where(['is_deleted' => 0 ,'id' => $id])->first();
    }

    public function getUserListByType($type)
    {
        return  User::where('user_type', $type)->where('status','Active')->orderBy('id', 'desc')->get();
    }

    public function getUserListByCondition($condition = [])
    {
        return  User::where(['is_deleted' => 0 ]+$condition)->where('status','Active')->orderBy('id', 'desc')->get();
    }

    public function getUnapproveClients($type)
    {
        return  User::where(['user_type' => $type,'is_verified' => 0,'status'  => 'Inactive'])->orderBy('id', 'desc')->get();
    }

    public function getDeactiveUserList($type,$id)
    {
        return  User::where(['user_type' => $type,'is_verified' => 1,'status'  => 'Inactive','id' => $id])->orderBy('id', 'desc')->get();
    }

    public function getContactPersonsByCondition($type,$status,$is_verified)
    {
// dd($type,$status,$is_verified);
        return UserAccount::join('users', 'user_accounts.user_id', '=', 'users.id')
        ->join('users as uc', 'users.client_id', '=', 'uc.id')
        ->where('user_accounts.is_deleted',0)
        ->where(['users.user_type' => $type , 'users.status' => $status , 'users.is_verified' => $is_verified])
        ->select('user_accounts.id','users.id as user_id', 'uc.name as client_name','users.name as user_name','users.email','users.contact')
     
        ->get();

    //     return UserAccount::with(['user'])
    //     ->whereHas('user', function ($query) use ($type,$status,$is_verified) {

    //     $query->whereHas('client');
        
    // })->where(['user_type' => $type , 'status' => $status , 'is_verified' => $is_verified])->where('status','Unapprove')->get();

    
    }
    public function getUserIdsByPermissions($permission_names = [])
    {
        return \DB::table('permissions')
            ->whereIn('permissions.name', $permission_names)
            ->join('model_has_permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
            ->join('users', 'users.id', '=', 'model_has_permissions.model_id')
            ->select('users.id')->get()->pluck('id');
    }

    public function deactiveUser($user_id)
    {
        return DB::transaction(function() use ($user_id){

            $user = User::find($user_id);

            if(isset($user->id) && $user->status == "Active")
            {
                $user->status = "Inactive";
            
                $user->update();

                $user_obj = new User;
                $user_ids = $user_obj->getUserIdsByPermissions(['All']);

                $client = $this->getUserById(Auth::user()->id);

                event(new SendNotification($client->id,$user_ids,'','viewdeactiveusers',$user->id,$client->name. ' has registered to deactivate Contact Person ' .$user->name));

            }
        
            return with($user);


        });
    }
    
    public function storeUser($object)
    {
        return DB::transaction(function() use ($object){
            // dd($object);

            $user = new User;
            $user->name = $object['name'];
        
            $user->contact = $object['contact_no'];

            if(isset($object['other_contact']) && strlen($object['other_contact']) > 0)
            {
                $user->other_contact = $object['other_contact'];

            }
            else
            {
                $user->other_contact = Null;


            }

            
            if(isset($object['email']) && strlen($object['email']) > 0)
            {
                $user->email = $object['email'];


            }
            else
            {
                $user->email = $this->generateEmail();
                // dd($user);
            }
            
            $user->user_type = $object['user_type'];
            
            if(isset($object['password']))
            {
             $user->password = Hash::make($object['password']);

            }
            else
            {
                $user->password = $this->generatePassword();

            }

            if(isset($object['account_type']))
            {
                $user->account_type = $object['account_type'];

            }

            if(isset($object['client_group']))
            {
                $user->client_group = $object['client_group'];

            }
            if(isset($object['is_verified']))
            {
                $user->is_verified = $object['is_verified'];

            }
            if(isset($object['status']))
            {
                $user->status = $object['status'];

        }

            if(isset($object['address']))
            {
                $user->address = $object['address'];

            }
          
            if(isset($object['city']))
            {
                $user->city = $object['city'];

            }
         

            if(isset($object['province']))
            {
                $user->province = $object['province'];

            }
          

            if(isset($object['postal_code']))
            {
                $user->postal_code = $object['postal_code'];

            }
          

            $user->save();

                if($user->user_type == "Contact Person")
                {
       
                    if(isset($object['account']) && @count($object['account']) > 0)
                    {
                       
                        $account_info = [];

                        foreach($object['account'] as $key => $rows)
                        {

                            $account_info = [

                                'user_id'  => $user->id,            
                                'account_id'    =>  $rows,

                            ];
                            if(isset($object['note']))
                            {
                                $account_info += [
                                    'description'    =>  $object['note'],

                                ];
                            }
                            // dd($account_info);

                            $user_account = new UserAccount;
                            $user_account = $user_account->storeUserAccount($account_info);
                        }
                     

                    }
                    else
                    {
                        $account_info = [

                            'user_id'  => $user->id,
                            'parent_id'  => Auth::user()->id,
        
                        ];
                        if(isset($object['note']))
                        {
                            $account_info += [
                                'description'    =>  $object['note'],

                            ];
                        }


                        $user_account = new UserAccount;
                        $user_account = $user_account->storeUserAccount($account_info);
                    }

                    $user->client_id    =   Auth::user()->id;
                    $user->update();
                    
                    $user_obj = new User;
                    $user_ids = $user_obj->getUserIdsByPermissions(['All']);
    
                    event(new SendNotification(Auth::user()->id,$user_ids,'','unapprovecontactpersons',0,'Request to add a new contact person '.$user->name. ' has been created by '. Auth::user()->name));


    
                }
            // $user->assignRole($object['user_type']);

        return with($user);


        });
    }

    public function generateEmail()
    {
        $max   = User::max('id');
        $email = 'tes'.uniqid().'@cms.net';
        return $email;
    }
     
    public function updateUser($object)
    {
        return DB::transaction(function() use ($object){

            $user = User::find($object['user_id']);

            if(isset($user->id))
            {

            $user->name = $object['name'];

            if(isset($object['cnic']))
            {
                $user->cnic = $object['cnic'];

            }

            $user->contact = $object['contact_no'];

            $user->email = $object['email'];
            
            // $user->user_type = $object['user_type'];
            
            if(isset($object['password']))
            {
             $user->password = Hash::make($object['password']);

            }
            else
            {
                $user->password = $this->generatePassword();

            }

            if(isset($object['account_type']))
            {
                $user->account_type = $object['account_type'];

            }

            if(isset($object['status']))
            {
                $user->status = $object['status'];

            }

            $user->update();

            // if($user->user_type == "Contact Person")
            // {
            //     $user_obj = new User;
            //     $user_ids = $user_obj->getUserIdsByPermissions(['All']);

            //     event(new SendNotification(Auth::user()->id,$user_ids,'','unapprovecontactpersons',0,'Request to add a new contact person '.$user->name. ' has been created by '. Auth::user()->name));

            // }

            // $user->assignRole($object['user_type']);

            }
        return with($user);


        });
    }

    public function registerUser($object)
    {
        return DB::transaction(function() use ($object){

            $user = new User;

            $user->name        = $object['name'];
            $user->email       = $object['email'];
            // $user->cnic       = $object['cnic'];
            $user->contact       = $object['contact'];
    
            // $user->password    = $user->generatePassword();
            $user->status    =   'Inactive';
            $user->user_type    =   'Client';
            $user->save();

            $user->assignRole(['Client']);
            if(isset($user->id))
            {
                $user_obj = new User;
                $user_ids = $user_obj->getUserIdsByPermissions(['All']);

                \Mail::to($user->email)->send(new \App\Mail\RegistrationMail($user));
    
                event(new SendNotification($user->id,$user_ids,'','unapproveclients',0,'A new client '.$user->name. ' has registered to your system'));
    
            return with($user);

            }



        });
    }

    public function generatePassword()
    {
        return Hash::make(Str::random(5));
    }

    // public function assignCreateUserRole($user, $type)
    // {
    //     $role = Role::findOrCreate($type);
    //     if (isset($role->id)) {
    //         $user->assignRole([$role->id]);
            
    //     }
    // }

    public function userRoles()
    {

        return $this->belongsToMany(Role::class,'model_has_roles','model_id');
    }
    public function client()
    {

        return $this->belongsTo(User::class,'client_id');
    }
    public function transactions()
    {

        return $this->hasMany(Transaction::class,'client_id');
    }
    public function accounts()
    {

        return $this->hasMany(Account::class,'client_id');
    }

    // public function userAccounts()
    // {
    //     return $this->hasMany(UserAccount::class, 'parent_id');
    // }
    public function userAccounts()
    {
        return $this->hasMany(UserAccount::class, 'user_id');
    }
    // public function assignRole($roles = [])
    // {
    //     $this->userRoles()->sync($roles);
    // }

}

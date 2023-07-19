<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
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

    public function getUserById($id)
    {
        return User::where('id',$id)->first();
    }

    public function getUserListByType($type)
    {
        return  User::where('type', $type)->orderBy('id', 'desc')->get();
    }


    
    public function storeUser($object)
    {
        return DB::transaction(function() use ($object){

            $user = new User;
            $user->name = $object['name'];
            $user->cnic = $object['cnic'];
            $user->fname = $object['fname'];
            $user->contact = $object['contact_no'];
            $user->email = $object['email'];
            $user->type = $object['user_type'];
            if(isset($object['password']))
            {
             $user->password = Hash::make($object['password']);

            }
            else
            {
                $user->password = $this->generatePassword();

            }

            $user->save();

        return with($user);


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


    // public function assignRole($roles = [])
    // {
    //     $this->userRoles()->sync($roles);
    // }
}

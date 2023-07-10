<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user_list = User::all();
        return view('users.manage_users',[
            'user_list'  => $user_list
        ]);
    }
}

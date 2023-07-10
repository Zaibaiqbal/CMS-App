<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index()
    {

        $trucks_list = Truck::all();
        return view('trucks.manage_trucks',[
            'trucks_list'  =>  $trucks_list
        ]);
    }
}

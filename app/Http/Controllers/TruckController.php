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

    public function storeTruck(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

            $request->validate([

                'plate_no'              => 'required|unique:trucks,plate_no',
                'vin_no'                => 'required|unique:trucks,plate_no',
                'model'                 => 'required|max:255',
                'load_capacity'         => 'required|gt:0',
                'company'               => 'required|max:255',

                ]);
                $form_data = $request->input();

                $truck = new Truck;
                $truck = $truck->storeTruck($form_data);

                if(isset($truck->id))
                {
                    $data = ['status' => true, 'message' => 'Truck added successfully'];

                }
            }
            else
            {
                return view('trucks.modals.add_truck');
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }
}

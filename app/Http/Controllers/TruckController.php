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
                // 'vin_no'                => 'required|unique:trucks,plate_no',
                'model'                 => 'required|max:255',
                'tare_weight'           => 'required|gt:0',
                'company'               => 'required|max:255',

                ]);
                $form_data = $request->input();

                $truck = new Truck;
                $truck = $truck->storeTruck($form_data);

                if(isset($truck->id))
                {
                    $data = ['status' => true, 'message' => 'Truck added successfully'];

                    if (isset($request->flag)) 
                    {
                        if($request->flag)
                        {
                            $data['plate_no']       = $truck->plate_no;
                            $data['id']             = encrypt($truck->id);
                            // $data['client_id']      = encrypt($truck->client->id);
                            // $data['name']           = $truck->client->name;
                            // $data['contact']        = $truck->client->contact;

                            return $data;
                        }    
                     
                    }

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

    public function autoSearchPlateNo(Request $request)
    {

        try
        {
            $data = Truck::selectRaw('plate_no,id')
                    ->where('plate_no', 'LIKE', '%'. $request->search. '%')
                    ->get();
     
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }
}

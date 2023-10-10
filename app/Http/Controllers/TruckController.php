<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\TruckAssignment;
use App\Models\User;
use App\Models\UserAccount;
use App\Rules\PlateNoRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TruckController extends Controller
{
    public function index()
    {

        $trucks_list = TruckAssignment::whereHas('user')->whereHas('truck')->get();
        return view('trucks.manage_trucks',[
            'trucks_list'  =>  $trucks_list
        ]);
    }

    public function clientTruckList()
    {

        $truck = new Truck;

        $id = Auth::user()->id;
        
        if(Auth::user()->user_type == "Contact Person")
        {
            $user = new User;

            $user = $user->getUserById(Auth::user()->id);
            if(isset($user->id))
            {
                $id = $user->client_id;

            }

        }
        $trucks_list = $truck->getClientTrucks($id);

        // dd($trucks_list);
        return view('clients.client_trucks.manage_client_trucks',[
            'trucks_list'  =>  $trucks_list
        ]);
    }

    public function getClientAccount(Request $request)
    {
        $data = ['view' => '' ];

        $truck = new TruckAssignment;

        $truck = $truck->getTruckAssignmentByCondition(['id' => $request->truck_id]);
        if(isset($truck->id))
        {
            $user_account = new UserAccount;
            $account_list = $user_account->getAccountListByClientId($truck->client_id);
            $data['client_name']    = $truck->user->name;
            $data['contact']        = $truck->user->contact;
            $data['view']           = '<option value="'.encrypt(0).'">Select Account</option>';
    
            foreach($account_list as $rows)
            {
                  
                $data['view'] .= '<option value="'.encrypt($rows->id).'">'.$rows->title.'-'.$rows->account_no.'</option>';
    
            }
    
        }
       
        return $data;
    }
    

    public function storeTruck(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

            $request->validate([

                'plate_no'              => ['required',new PlateNoRule(decrypt($request->client),$request->plate_no)],

                // 'vin_no'                => 'required|unique:trucks,plate_no',
                // 'model'                 => 'required|max:255',
                // 'tare_weight'           => 'required|gt:0',
                // 'company'               => 'required|max:255',

                ]);
                $form_data = $request->input();

// dd($form_data);
                if(Auth::user()->user_type == "Contact Person")
                {
                    $user = new User;

                    $user = $user->getUserById(Auth::user()->id);
                    if(isset($user->id))
                    {
                        $form_data['client_id'] = $user->client_id;

                    }

                }
                else if(Auth::user()->user_type == "Client")
                {
                    $form_data['client_id'] = Auth::user()->id;

                }
                else
                {

                    $form_data['client_id'] = decrypt($request->client);
                }
                

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
                            $data['id']             = $truck->id;
                            // $data['client_id']      = encrypt($truck->client->id);
                            // $data['name']           = $truck->client->name;
                            // $data['contact']        = $truck->client->contact;

                            return $data;
                        }    
                     
                    }

                }
                return $data;
            }
            else
            {
                if(url()->current() == url('storeclienttruck'))
                {
                    return view('clients.client_trucks.modals.add_client_truck');

                }
                else
                {
                    $user  = new User;
                    $client_list = $user->getUserListByType('Client');
            

                return view('trucks.modals.add_truck',[
                    'client_list'  => $client_list
                ]);

                }
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }

    public function updateTruck(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

                $request->validate([

                'plate_no'              => 'required',
                'truck'                 => 'required|exists:trucks,id',
                'model'                 => 'required|max:255',
                'tare_weight'           => 'required|gt:0',
                'company'               => 'required|max:255',

                ]);
                $form_data = $request->input();


                if(Auth::user()->user_type == "Contact Person")
                {
                    $user = new User;

                    $user = $user->getUserById(Auth::user()->id);
                    if(isset($user->id))
                    {
                        $form_data['client_id'] = $user->client_id;

                    }

                }
                else if(Auth::user()->user_type == "Client")
                {
                    $form_data['client_id'] = Auth::user()->id;

                }
                else
                {

                    $form_data['client_id'] = decrypt($request->client);
                }
                

                $truck = new Truck;
                $truck = $truck->updateTruck($form_data);

                if(isset($truck->id))
                {
                    $data = ['status' => true, 'message' => 'Truck updated successfully'];

                    if (isset($request->flag)) 
                    {
                        if($request->flag)
                        {
                            $data['plate_no']       = $truck->plate_no;
                            $data['id']             = $truck->id;
                            // $data['client_id']      = encrypt($truck->client->id);
                            // $data['name']           = $truck->client->name;
                            // $data['contact']        = $truck->client->contact;

                            return $data;
                        }    
                     
                    }

                }
                return $data;
            }
            else
            {
                $truck = new Truck;
                $truck = $truck->getTruckById(decrypt($request->id));

                if(url()->current() == url('updateclienttruck'))
                {
                    return view('clients.client_trucks.modals.update_client_truck',[
                        'truck'         =>  $truck
                    ]);

                }
                else
                {
                    $user  = new User;
                    $client_list = $user->getUserListByType('Client');
            

                    return view('trucks.modals.update_truck',[
                        'client_list'  => $client_list,
                        'truck'         =>  $truck
                    ]);

                }
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
            $data = TruckAssignment::join('users as u','u.id','=','truck_assignments.client_id')
                    ->join('trucks as t','t.id','=','truck_assignments.truck_id')
                    ->selectRaw("t.plate_no,t.id,u.name,u.contact,u.id as user_id,u.client_group,concat(t.plate_no,'-',u.name) as identifier")
                    ->where('t.plate_no', 'LIKE', '%'. $request->search. '%')
                    ->get();
     
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }


    public function autoSearchTruckInfo(Request $request)
    {

        try
        {
            $data = Truck::where('trucks.plate_no', 'LIKE', '%'. $request->search. '%')
            ->distinct('trucks.plate_no')
                    ->get();
     
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }

    public function getClientTruckList(Request $request)
    {

        try
        {
            $option = '';

            $client_id = decrypt($request->client_id);
// dd($client_id);
            $truck = new Truck;

            $trucks_list = $truck->getClientTruckList($client_id);

            foreach($trucks_list as $rows)
            {
                $option .=  '<option value="'.encrypt($rows->truck->id).'">'.$rows->truck->plate_no.'</option>';

            }

            return $option;
        }
        catch(Exception $e)
        {

        }

    }

}




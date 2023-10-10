<?php

namespace App\Http\Controllers;

use App\Models\TruckAssignment;
use App\Models\User;
use Illuminate\Http\Request;

class TruckAssignmentController extends Controller
{
    public function storeTruckAssignment(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

                $request->validate([

                    'truck.*'                   => ['required'],

                    'client'                    => 'required',
                    'assign_client'             => 'required',

                    ]);
                $form_data = $request->input();

                $form_data['client_id'] = decrypt($form_data['client']);
                $form_data['assign_client_id'] = decrypt($form_data['assign_client']);


                if(@count($form_data['truck']) > 0)
                {
                    foreach($form_data['truck'] as $key => $rows)
                    {
                        $form_data['truck'][$key] =  decrypt($rows);
                    }

                }

                $truck_assignment = new TruckAssignment;

                $truck = $truck_assignment->storeBulkTruckAssignment($form_data);
                if(($truck['status']))
                {

                   return $data = ['status' => true, 'message' => 'Truck assignment successfully'];

                }
                else
                {
                    return $truck;
                }
                return $data;
            }
            else
            {
               
                $user  = new User;
                $client_list = $user->getUserListByType('Client');
        
                return view('trucks.modals.truck_assignment',[
                    'client_list'  => $client_list
                ]);

            }
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }
}

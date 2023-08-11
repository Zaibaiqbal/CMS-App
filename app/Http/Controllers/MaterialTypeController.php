<?php

namespace App\Http\Controllers;

use App\Models\MaterialRate;
use App\Models\MaterialType;
use App\Models\User;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    public function index()
    {

        $user  = new User;
        $material_types_list = MaterialType::get();
        return view('material_types.manage_material_types',[

            'material_types_list'   =>  $material_types_list,

        ]);
    }

    public function viewMaterialList()
    {

        $user  = new User;
        $material_types_list = MaterialType::get();
        $material_rate = new MaterialRate;

        $material_rate_list = $material_rate->getMaterialRateList();
        $client_list = $user->getUserListByType('Client');
        return view('material_types.manage_material_rates',[

            'material_types_list'   =>  $material_types_list,
            'client_list'           =>  $client_list,
            'material_rate_list'           =>  $material_rate_list,

        ]);
    }

    

    public function storeMaterialType(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
        
            $request->validate([

                'type'                      => 'required|max:255',
               
               

                ]);
                $form_data = $request->input();


                $type = new MaterialType;
                $type->name = $form_data['type'];
            
                $type->save();

                if(isset($type->id))
                {
                    $data = ['status' => true, 'message' => 'Material Type added successfully'];

                }
           
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }

    public function storeMaterialRate(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
        
            $request->validate([

                'material_type_id'                      => 'required|exists:material_types,id',
                'client'                                => 'required|exists:users,id',
                'rate'                                  => 'required|gt:0',
               

                ]);
                $form_data = $request->input();

                // $form_data['client']   = decrypt($form_data['client']);

                $material_rate = new MaterialRate;
                $material_rate = $material_rate->storeMaterialRate($form_data);

                if(isset($material_rate->id))
                {
                    $data = ['status' => true, 'message' => 'Material Type added successfully'];

                }
           
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }


}

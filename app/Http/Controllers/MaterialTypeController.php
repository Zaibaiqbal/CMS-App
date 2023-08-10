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
        $client_list = $user->getUserListByType('Client');
        return view('material_types.manage_material_types',[

            'material_types_list'   =>  $material_types_list,
            'client_list'           =>  $client_list,

        ]);
    }

    public function storeMaterialType(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
        
            $request->validate([

                'type'                      => 'required|max:255',
                'client'                    => 'required',
                'rate'                    => 'required|gt:0',
               

                ]);
                $form_data = $request->input();

                $form_data['client']   = decrypt($form_data['client']);

                $type = new MaterialType;
                $type->name = $form_data['type'];
            
                $type->save();

                $form_data['material_type_id']  = $type->id;

                $material_rate = new MaterialRate;
                $material_rate = $material_rate->storeMaterialRate($form_data);

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

}

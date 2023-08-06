<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use Illuminate\Http\Request;

class MaterialTypeController extends Controller
{
    public function index()
    {

        $material_types_list = MaterialType::get();
        return view('material_types.manage_material_types',[
            'material_types_list'  =>  $material_types_list
        ]);
    }

    public function storeMaterialType(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
        
            $request->validate([

                'type'                  => 'required|max:255',
               

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

}

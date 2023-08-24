<?php

namespace App\Http\Controllers;

use App\Models\MaterialRate;
use App\Models\MaterialType;
use App\Models\User;
use Exception;
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

    public function getMaterialInfo(Request $request)
    {
        try
        {
            // dd($request->input());
            $data = [];
            $material_id = decrypt($request->material);
            $material = new MaterialType;
            $material_rate = new MaterialRate;

            if(isset($request->user_id) && $request->user_id > 0)
            {
               $material_rate =  $material_rate->getMaterialRateByCondition(['material_type_id' => $material_id , 'client_id' => $request->user_id]);

               $data['rate'] = $material_rate->rate;
            }
            else
            {
               $material_rate =  $material->getMaterialTypeById($material_id);
               $data['rate'] = $material_rate->board_rate;

            }
            return $data;


        }
        catch(Exception $e)
        {

        }
    }

    public function storeMaterialType(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
        
            $request->validate([

                'type'                      => 'required|max:255',
                'board_rate'                      => 'required',
               
               

                ]);
                $form_data = $request->input();


                $type = new MaterialType;
                $type->name = $form_data['type'];
                $type->board_rate = $form_data['board_rate'];
            
                $type->save();

                if(isset($type->id))
                {
                    $data = ['status' => true, 'message' => 'Material added successfully'];

                }
           
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }

    public function updateMaterialType(Request $request)
    {
        try
        {
            $data = ['status' => false, 'message' => ''];

            if($request->isMethod('post'))
            {
        
                $request->validate([
    
                    'type'                      => 'required|max:255',
                    'material_type_id'                      => 'required|exists:material_types,id',
                    'board_rate'                      => 'required|gte:0',
                   
                   
    
                    ]);
                    $form_data = $request->input();
    
                    $type = MaterialType::find($form_data['material_type_id']);
                    if(isset($type->id))
                    {
                        $type->name = $form_data['type'];
                        $type->board_rate = $form_data['board_rate'];

                        $type->update();
        
                        $data = ['status' => true, 'message' => 'Material updated successfully'];
                    
                    }
                 
                return $data;
            }
            else
            {
                      
            $material_type = new MaterialType;
            $material_type = $material_type->getMaterialTypeById(decrypt($request->id));

                return view('material_types.modals.update_material_type',[
                    'material_type'   =>  $material_type
                ])->render();

            }
        

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
                    $data = ['status' => true, 'message' => 'Material Rate added successfully'];

                }
           
            return $data;

        }
        catch(Exception $e)
        {

        }

        // return redirect()->back();
      
    }

    public function updateMaterialRate(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {

                $data = ['status' => false, 'message' => ''];
        
                $request->validate([
    
                    'material_type_id'                      => 'required|exists:material_types,id',
                    'client'                                => 'required|exists:users,id',
                    'rate'                                  => 'required|gte:0',
                    'material_rate'                                  => 'required',
                   
    
                    ]);
                    $form_data = $request->input();
    
                    $form_data['material_rate']   = decrypt($form_data['material_rate']);
                    $material_rate = new MaterialRate;
                    $material_rate = $material_rate->updateMaterialRate($form_data);
    
                    if(isset($material_rate->id))
                    {
                        $data = ['status' => true, 'message' => 'Material Rate updated successfully'];
    
                    }
               
                return $data;
            }
            else
            {
                $material_rate = new MaterialRate;
                $material = new MaterialType;
                $user = new User;

                $material_rate = $material_rate->getMaterialRateByCondition(['id' => decrypt($request->id)]);
                $material_types_list = $material->getMaterialTypeList();
                $client_list = $user->getUserListByType('Client');
                   
                return view('material_types.modals.update_material_rate',[

                    'material'              => $material_rate,
                    'material_types_list'   =>  $material_types_list,
                    'client_list'           =>  $client_list,

                ])->render();
            }


        }
        catch(Exception $e)
        {

        }

      
    }

}

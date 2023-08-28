<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{

    public function getValidationList($validation = [])
    {
        return $validation + [

            'file'        =>  'required|mimes:csv,txt|max:2000',
        ];
    }


    public function importClientData(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                $validator = Validator::make($request->all(),$this->getValidationList());
                
                if($validator->fails())
                {
                    $this->setErrorMessage(422,'error',$validator->errors()->first());
                }

                DB::transaction(function() use ($request) {
        
        
                    $path = $request->file('file')->getRealPath();
        
                    if($request->has('header')) 
                    {
                        $data = Excel::load($path, function($reader) {})->get()->toArray();
                    }
                    else 
                    {
                        $data = array_map('str_getcsv', file($path));
                    }
        
                
                    unset($data[0]);
                    
        
                    foreach($data as $key => $rows)
                    {
        
                        if(strlen(trim($rows[0])) > 0)
                        {
                            
        
                        }  
                    }            
        
                    $this->setErrorMessage(200,'success','Csv succssfully uploaded');
                    
                });
             
    
            }
            else
            {
                return view('data-import.modals.client_import')->render();
    
            }
        }
        catch(Exception $e)
        {

        }
     
    }

}

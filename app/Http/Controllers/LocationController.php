<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {

        $location_list = Location::get();
        return view('locations.manage_locations',[
            'location_list'  =>  $location_list
        ]);
    }

    public function storeCategory(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

            $request->validate([

                'name'                 => 'required|max:255',
        

                ]);
                $form_data = $request->input();

                $category = new Category;
                $category = $category->storeCategory($form_data);

                if(isset($category->id))
                {
                    $data = ['status' => true, 'message' => 'Category added successfully'];


                }
            }
            else
            {
               
                return view('locations.modals.add_category',[



                ]);

                
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

        return redirect()->back();
      
    }


    public function storeLocation(Request $request)
    {
        try
        {

            $data = ['status' => false, 'message' => ''];
            
            if($request->isMethod('post'))
            {

            $request->validate([

                'category'              => 'required',
                // 'vin_no'                => 'required|unique:trucks,plate_no',
                'name'                 => 'required|max:255',
                'contact'               => 'nullable|max:255',
                'address'               => 'required|max:255',

                ]);
                $form_data = $request->input();

            

                    $form_data['category'] = decrypt($request->category);
                
                $location = new Location;
                $location = $location->storeLocation($form_data);

                if(isset($location->id))
                {
                    $data = ['status' => true, 'message' => 'Location added successfully'];

                }
            }
            else
            {
              
                    $category  = new Category;
                    $category_list = $category->getCategoryList();
            

                return view('locations.modals.add_location',[
                    'category_list'  => $category_list
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

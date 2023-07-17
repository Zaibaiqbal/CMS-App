<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Support\Facades\Auth;

class Truck extends Model
{
    use HasFactory;

    public function storeTruck($object)
    {
        return DB::transaction(function() use ($object){

            $truck = new Truck;
            $truck->plate_no        = $object['plate_no'];
            $truck->vin_no          = $object['vin_no'];
            $truck->added_id        = Auth::user()->id;
            $truck->company         = $object['company'];
            $truck->model           = $object['model'];

            if(isset($object['description']))
            {
                $truck->description     = $object['description'];

            }

            if(isset($object['color']))
            {
                $truck->color           = $object['color'];

                
            }

            $truck->save();

            return with($truck);
        });

    }
}

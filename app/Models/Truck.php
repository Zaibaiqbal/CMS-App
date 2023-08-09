<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Support\Facades\Auth;

class Truck extends Model
{
    use HasFactory;


    public function getClientTrucks()
    {
        return Truck::where('is_deleted', 0)->where('client_id',Auth::user()->id)->get();

    }
    public function getTruckByPlateNo($plate_no)
    {
        return Truck::where('is_deleted', 0)->where('plate_no',$plate_no)->first();

    }

    public function storeTruck($object)
    {
        return DB::transaction(function() use ($object){

            $truck = new Truck;
            $truck->plate_no        = $object['plate_no'];
            
            if(isset($object['vin_no']))
            {
                $truck->vin_no          = $object['vin_no'];

            }
            $truck->added_id        = Auth::user()->id;

            $truck->client_id        = Auth::user()->id;

            $truck->company         = $object['company'];
            $truck->model           = $object['model'];
            $truck->tare_weight           = $object['tare_weight'];

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

    public function user()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
    }
}

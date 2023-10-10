<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Support\Facades\Auth;

class Truck extends Model
{
    use HasFactory;


    public function getClientTrucks($id)
    {
        return Truck::where('is_deleted', 0)->where('client_id',$id)->get();

    }
    public function getTruckByPlateNo($plate_no)
    {
        return Truck::where('is_deleted', 0)->where('plate_no',$plate_no)->first();

    }

    public function getTruckByCondition($plate_no,$client_id)
    {
        return Truck::where('is_deleted', 0)->where('client_id',$client_id)->where('plate_no',$plate_no)->first();

    }
    public function getTruckById($id)
    {
        return Truck::where('is_deleted', 0)->where('id',$id)->first();

    }

    public function getTruckListByPlateNo($plate_no)
    {
        

        return TruckAssignment::whereHas('truck', function($query) use ($plate_no)
        {
            $query->where('is_deleted', 0)->where('plate_no', 'LIKE', '%'. $plate_no. '%');
        })->get();

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
            // $truck->added_id        = Auth::user()->id;

            // $truck->client_id        = $object['client_id'];

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
            // $this->generateIdentifier($truck);

            $truck_assignment = new TruckAssignment;
            $truck_assignment->storeTruckAssignment([
                'client_id'     =>   $object['client_id'],
                'added_id'      =>   Auth::user()->id,
                'truck_id'      =>   $truck->id,
            ]);

            return with($truck);
        });

    }

    public function updateTruck($object)
    {
        return DB::transaction(function() use ($object){

            $truck = Truck::find($object['truck']);

            if(isset($truck->id))
            {

            $truck->plate_no        = $object['plate_no'];
            
            if(isset($object['vin_no']))
            {
                $truck->vin_no          = $object['vin_no'];

            }
            // $truck->added_id        = Auth::user()->id;

            // $truck->client_id        = $object['client_id'];

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

            $truck->update();
            // $this->generateIdentifier($truck);

        }

            return with($truck);
        });

    }
    
    public function generateIdentifier($truck)
    {
         $truck->identifier = $truck->plate_no.'-'.$truck->user->name;

         $truck->update();
    }

    public function getClientTruckList($id)
    {
        return TruckAssignment::whereHas('user',function($query){
            
        })->where('client_id',$id)->get();

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'truck_assignment');
    }


    public function user()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
    }
}

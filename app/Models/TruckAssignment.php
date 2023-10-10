<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class TruckAssignment extends Model
{
    use HasFactory;

    public function getTruckAssignmentByCondition($condition = [])
    {
        return TruckAssignment::where($condition)->first();

    }
    public function storeBulkTruckAssignment($object)
    {
        return DB::transaction(function() use ($object){


            foreach($object['truck'] as $rows)
            {
                $truck_assignment = new TruckAssignment;

                $verify = $this->verifyTruckAssignmentToClient($rows,$object['assign_client_id']);
                if($verify['status'])
                {
                    $truck_assignment->storeTruckAssignment([
                        'client_id'     =>   $object['assign_client_id'],
                        'added_id'      =>   Auth::user()->id,
                        'truck_id'      =>   $rows,
                    ]);
                }
              
            }
            return with($verify);

        });

    }

    public function storeTruckAssignment($object)
    {
        return DB::transaction(function() use ($object){

            $truck_assignment = new TruckAssignment;

            $truck_assignment->added_id         = Auth::user()->id;

            $truck_assignment->client_id        = $object['client_id'];

            $truck_assignment->truck_id         = $object['truck_id'];
           
            $truck_assignment->save();
           
            return with($truck_assignment);
        });

    }

    public function verifyTruckAssignmentToClient($truck_id,$client_id)
    {

        $data = ['status' => true , 'message' => ''];

        $truck_assignment = $this->getTruckAssignmentByCondition([
            'truck_id' => $truck_id,
            'client_id' => $client_id
        ]);

        if(isset($truck_assignment->id))
        {
            $data = ['status' => false, 'message' => 'Truck already assigned to this client'];
        }
        else
        {
            $data = ['status' => true];

        }
        return $data;

    }

    public function user()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class,'truck_id')->withDefault();
    }
    
}

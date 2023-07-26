<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    public function getTransactionByAddedId()
    {

        return Transaction::where(['is_deleted' => 0,'added_id' => Auth::user()->id])->orderby('id','DESC')->get();
    }
    
    public function storeTransaction($object)
    {

        return DB::transaction(function() use ($object){

            $transaction = new Transaction;
            if($object['truck_id'] > 0)
            {
                $truck = Truck::find($object['truck_id']);

            }
            else
            {
                $truck  = new Truck;
                $truck = $truck->getTruckByPlateNo($object['plate_no']);
            }
            $transaction->truck_id = $truck->id;
            $transaction->added_id = Auth::user()->id;

            $transaction->plate_no = $truck->plate_no;
            $transaction->material_type_id = $object['material_type'];
            $transaction->operation_type = $object['operation_type'];

            $transaction->client_id = $object['client'];

            $transaction->gross_weight = $object['gross_weight'];
            $transaction->tare_weight = $object['tare_weight'];
            $transaction->net_weight = $object['net_weight'];
            
            $transaction->save();

            $driver = new Driver;

            $driver->name  = $object['driver_name'];

            $driver->save();

            $transaction->driver_id  = $driver->id;

            $transaction->update();

        return with($transaction);


        });

}

    public function client()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
    }


    public function materialType()
    {
        return $this->belongsTo(MaterialType::class,'material_type_id')->withDefault();
    }
}

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

    public function getTransactionById($id)
    {

        return Transaction::where(['is_deleted' => 0,'added_id' => Auth::user()->id,'id' => $id])->first();
    }

    
    
    public function storeTransaction($object)
    {

        return DB::transaction(function() use ($object){

            $transaction = new Transaction;
          
            $truck = Truck::find($object['truck_id']);

            if(isset($truck->id))
            {

                $transaction->truck_id = $truck->id;
                $transaction->added_id = Auth::user()->id;

                

                $transaction->plate_no = $truck->plate_no;
                // $transaction->material_type_id = $object['material_type'];
                $transaction->operation_type = $object['operation_type'];

                $transaction->client_id = $object['user_id'];
                if(isset($object['account']))
                {
                    $transaction->account_id = $object['account_id'];

                }

                if(isset( $object['tare_weight']))
                {
                    $transaction->tare_weight = $object['tare_weight'];

                }
                if(isset( $object['gross_weight']))
                {
                    $transaction->gross_weight = $object['gross_weight'];

                }
                // $transaction->gross_weight = $object['gross_weight'];
                // $transaction->net_weight = $object['net_weight'];
                $transaction->ticket_no = $this->generateTicketNo();
                
                // dd($transaction);
                $transaction->save();

                $driver = new Driver;

                $driver->name  = $object['driver_name'];

                $driver->save();

                $transaction->driver_id  = $driver->id;

                $transaction->update();
            }


        return with($transaction);


        });

    }

    public function updateTransaction($object)
    {

        return DB::transaction(function() use ($object){
          
            $transaction = Transaction::find($object['transaction_id']);

            if(isset($transaction->id))
            {
                $transaction->added_id = Auth::user()->id;

                $transaction->gross_weight = $object['gross_weight'];
                $transaction->tare_weight = $object['tare_weight'];
                $transaction->net_weight = $object['net_weight'];
                $transaction->material_type_id = $object['material_type'];

                if($transaction->net_weight >= 0)
                {
                    $transaction->status = 'Close';
                }
                
                // dd($transaction);
                $transaction->update();

                $driver = new Driver;

                $driver->name  = $object['driver_name'];

                $driver->save();

                $transaction->driver_id  = $driver->id;

                $transaction->update();


            }


        return with($transaction);


        });

    }

    public function generateTicketNo()
    {
        $year = date('y');

        $max = Transaction::where('is_deleted',0)->max('id');

        return 'EZT-'.$year.'-'.str_pad(($max + 1), 5, '0', STR_PAD_LEFT).'-'.date('W').date('d');
        
    }
    public function client()
    {
        return $this->belongsTo(User::class,'client_id')->withDefault();
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class,'truck_id')->withDefault();
    }

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class,'account_id')->withDefault();
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class,'driver_id')->withDefault();
    }
    public function materialType()
    {
        return $this->belongsTo(MaterialType::class,'material_type_id')->withDefault();
    }
}

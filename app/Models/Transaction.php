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

    public function getTransactionsByUserId($id)
    {

        return Transaction::whereHas('userAccount' , function($query) use ($id){

            $query->where('user_id',$id)->orWhere('parent_id',$id);

        })->get();
    }
    
    public function storeTransaction($object)
    {

        // dd($object);
        return DB::transaction(function() use ($object){

            $transaction = new Transaction;
          
            if(isset($object['truck_id']))
            {
                $truck = Truck::find($object['truck_id']);

                if(isset($truck->id))
                {
                    $transaction->truck_id = $truck->id;
                }
            }
            
         
                $transaction->added_id = Auth::user()->id;

                // dd($object);
                $transaction->plate_no = $object['plate_no'];
                $transaction->client_name = $object['client'];
                $transaction->contact_no = $object['contact_no'];

                // $transaction->material_type_id = $object['material'];
                $transaction->operation_type = $object['operation_type'];

                if(isset($object['user_id']))
                {
                    $transaction->client_id = $object['user_id'];

                }

                if(isset($object['account']))
                {
                    $transaction->account_id = $object['account_id'];

                }

                // if(isset( $object['tare_weight']))
                // {
                //     $transaction->tare_weight = $object['tare_weight'];

                // }
                if(isset( $object['inweight']))
                {
                    $transaction->gross_weight = $object['inweight'];

                }

                if(isset( $object['vehicle_descp']))
                {
                    $transaction->vehicle_desc = $object['vehicle_descp'];

                }
                if(isset( $object['client_group']))
                {
                $transaction->client_group = $object['client_group'];

                }
                // $transaction->net_weight = $object['net_weight'];
                $transaction->ticket_no = $this->generateTicketNo();
                
                $transaction->save();

                // dd($transaction);

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

                $transaction->gross_weight = $object['inweight'];
                $transaction->tare_weight = $object['outweight'];
                $transaction->net_weight = $object['net_weight'];
                $transaction->material_type_id = $object['material_type'];

                    $transaction->status = 'Processed';
                
                
                if($transaction->operation_type == "Inbound" && isset($object['job_id']))
                {
                    $transaction->job_id = $object['job_id'];

                }     
                
                if(isset($object['account']))
                {
                    $transaction->account_id = $object['account'];

                }

                if(isset($object['material_rate']) && $transaction->client_type == "Numbered Account")
                {
                    $transaction->material_rate = $object['material_rate'];

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

    // public function calculatePrice($weightInTons) {
    //     // Calculate the base price for the first 0.25 tons
    //     $basePrice = $weightInTons * $basePricePerTon; // You need to define $basePricePerTon
    
    //     // Calculate the additional price for every 0.25 tons beyond the first 0.25 tons
    //     $additionalWeight = $weightInTons - 0.25;
    //     if ($additionalWeight > 0) {
    //         $additionalPrice = ceil($additionalWeight / 0.25) * $additionalPriceIncrement;
    //     } else {
    //         $additionalPrice = 0;
    //     }
    
    //     // Total price is the sum of base price and additional price
    //     $totalPrice = $basePrice + $additionalPrice;
    
    //     return $totalPrice;
    // }
    

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

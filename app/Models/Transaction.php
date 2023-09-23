<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getTransactionsByCondition($condition = [])
    {

        return Transaction::where('is_deleted' , 0)->where($condition)->orderby('id','desc')->get();
    }

    public function getDashboardTransactionsByCondition($condition,$from,$to)
    {

        $query = Transaction::where('is_deleted' , 0)->where($condition);

// dd($query->get());
        if(strlen(trim($from)) > 0 && strlen(trim($to)) > 0)
        {
           $query = $query->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to);
        }
       
         return $query->orderby('id','desc')->get();
    }

    public function getTransactionsClientList()
    {
        return User::join('transactions as t','t.client_id','=','users.id')->selectRaw("users.name as name,users.id")->groupby('users.id')->get();

    }

    

    public function viewDailyCustomerReport($condition = [])
    {
        return Transaction::leftjoin('users as c','c.id','=','transactions.client_id')
        ->join('payments as p','p.transaction_id','=','transactions.id')
        ->join('material_types as mt','mt.id','=','transactions.material_type_id')
        ->whereIn('transactions.client_group',$condition)
        ->where('transactions.status','Processed')
        ->whereDate('transactions.created_at',now())
        ->selectRaw("transactions.created_at,transactions.ticket_no,transactions.plate_no,mt.name as material_name,transactions.material_rate,p.amount,p.tax_amount,p.surcharge_amount,p.quantity")
        ->get();
    }

    public function getMaterialWiseClientTransactions($id)
    {

        $start_date = now()->startOfWeek(); 
        $end_date = now()->endOfWeek(); 

        return MaterialType::selectRaw("material_types.name,
        SUM(CASE WHEN t.operation_type = 'Inbound' THEN (t.gross_weight - t.tare_weight) ELSE 0 END) as inbound_net_weight,
        SUM(CASE WHEN t.operation_type = 'Outbound' THEN (t.gross_weight - t.tare_weight) ELSE 0 END) as outbound_net_weight,sum(p.rate) as material_rate,sum(p.tax_amount) as tax_amount,sum(p.amount) as amount")
        ->join('transactions as t', 'material_types.id', '=', 't.material_type_id')
        ->join('payments as p', 't.id', '=', 'p.transaction_id')
        ->where('t.client_id',$id)
        ->where('t.status','Processed')
        ->whereDate('t.created_at', '>=', $start_date)->whereDate('t.created_at', '<=', $end_date)->groupBy('material_types.id')->get();


        // return Transaction::join('payments as p','p.transaction_id','=','transactions.id')
        // ->join('material_types as mt','mt.id','=','transactions.material_type_id')
        
        // ->selectRaw("SUM(CASE WHEN transactions.operation_type = 'Inbound' THEN (transactions.gross_weight - transactions.tare_weight) ELSE 0 END) as inbound_net_weight,
        //     SUM(CASE WHEN transactions.operation_type = 'Outbound' THEN (transactions.gross_weight - transactions.tare_weight) ELSE 0 END) as outbound_net_weight")

        //     ->whereIn('transactions.client_group',$condition)
        //     ->where('transactions.status','Processed')

        //     ->whereDate('transactions.created_at','>',$start_date)
        //     ->whereDate('transactions.created_at','<',$end_date)
        //     ->groupby('c.id')
        //     ->get();

    }





    

    public function getTransactionsByClientId($id)
    {
        return Transaction::where('client_id',$id)->get();
        
        // join('accounts as a','a.id','=','transactions.account_id')
        // ->join('user_accounts as ua','ua.account_id','=','a.id')
        // ->join('users as c','c.id','=','transactions.client_id')

    }
    

    public function getTransactionsByUserId($id)
    {

        return Transaction::whereHas('userAccount' , function($query) use ($id){

            $query->where('user_id',$id)->orWhere('parent_id',$id);

        })->get();
    }

    public function getEmployeeProgressByCondition($id,$date)
    {
        $start_date = now()->startOfWeek(); 
        $start_date = $start_date->format('Y-m-d H:i:s');
// dd($start_date,$date);
        return Transaction::join('payments as p','p.transaction_id','=','transactions.id')
        ->join('material_types as mt','mt.id','=','transactions.material_type_id')
        ->where('transactions.added_id',$id)
        ->where('transactions.status','Processed')
        ->whereDate('transactions.created_at','>=',$start_date)
        ->whereDate('transactions.created_at','<=',$date)
        ->selectRaw("transactions.created_at,transactions.ticket_no,transactions.plate_no,mt.name as material_name,transactions.material_rate,p.amount,p.tax_amount,p.surcharge_amount,p.quantity")
        ->get();
    }
    
    public function getDailyMaterialWiseStats($condition = [],$from = "",$to ="")
    {

        // $query = MaterialType::join('transactions as t','material_types.id','=','t.material_type_id')
        // ->whereDate('t.created_at',now())
        // ->where($condition)

        // ->selectRaw("material_types.name,sum(t.gross_weight) as gross_weight,sum(t.tare_weight) as tare_weight");

        // if(strlen(trim($from)) > 0 && strlen(trim($to)) > 0)
        // {
        //    $query = $query->whereDate('t.created_at','>=',$from)->whereDate('t.created_at','<=',$to);
        // }
       
        // return $query->groupby('material_types.id',)->get();

        $query = MaterialType::selectRaw("material_types.name,
            SUM(CASE WHEN t.operation_type = 'Inbound' THEN (t.gross_weight - t.tare_weight) ELSE 0 END) as inbound_net_weight,
            SUM(CASE WHEN t.operation_type = 'Outbound' THEN (t.gross_weight - t.tare_weight) ELSE 0 END) as outbound_net_weight")
            ->join('transactions as t', 'material_types.id', '=', 't.material_type_id')
            ->where($condition);

        if (strlen(trim($from)) > 0 && strlen(trim($to)) > 0) {
            $query = $query->whereDate('t.created_at', '>=', $from)->whereDate('t.created_at', '<=', $to);
        }

        return $query->groupBy('material_types.id')->get();

    }

    public function getMonthlyMaterialWiseStats($condition = [])
    {

        return MaterialType::join('transactions as t','material_types.id','=','t.material_type_id')
        ->whereMonth('t.created_at', Carbon::now()->month)
        ->where($condition)

        ->selectRaw("material_types.name,sum(t.gross_weight) as gross_weight,sum(t.tare_weight) as tare_weight")
        ->groupby('material_types.id')->get();
    }
    
    
    public function storeTransaction($object)
    {

        // dd($object);
        return DB::transaction(function() use ($object){

            $transaction = new Transaction;
          
            $transaction->plate_no = $object['plate_no'];

            if(isset($object['truck_id']))
            {
                $truck = Truck::find($object['truck_id']);

                if(isset($truck->id))
                {
                    $transaction->truck_id = $truck->id;
                    $transaction->client_id = $truck->user->id;
                    $transaction->plate_no = $truck->plate_no;

                }
            }
            // dd($transaction);
            
         
                $transaction->added_id = Auth::user()->id;

                // dd($object);

                if(isset($object['client']))
                {
                    $transaction->client_name = $object['client'];
                }
                if(isset($object['contact_no']))
                {
                $transaction->contact_no = $object['contact_no'];
                }
                // $transaction->material_type_id = $object['material'];
                // $transaction->operation_type = $object['operation_type'];

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
                if(isset( $object['is_identified']))
                {
                    $transaction->is_identified = $object['is_identified'];

                }
                // $transaction->net_weight = $object['net_weight'];
                $transaction->ticket_no = $this->generateTicketNo();
                
                $transaction->save();

                // dd($transaction);

        return with($transaction);


        });

    }

    public function processTransaction($object)
    {

        return DB::transaction(function() use ($object){
          
            $transaction = Transaction::find($object['transaction_id']);
        //   dd($object);

            if(isset($transaction->id))
            {

                if(isset($object['truck_id']))
                {
                    $truck = Truck::find($object['truck_id']);

                    if(isset($truck->id))
                    {
                        $transaction->truck_id = $truck->id;
                        $transaction->client_id = $truck->user->id;
                        $transaction->plate_no = $truck->plate_no;

                    }

                    $transaction->truck_id = $object['truck_id'];

                }

                $transaction->added_id = Auth::user()->id;

                $transaction->gross_weight = $object['inweight'];
                $transaction->tare_weight = $object['outweight'];
                $transaction->net_weight = abs($object['net_weight']);
                
                if($object['net_weight'] < 0)
                {
                    $transaction->operation_type = 'Outbound';
                    
                }
                else
                {
                    $transaction->operation_type = 'Inbound';

                }

                $transaction->material_type_id  = $object['material_type'];

                $transaction->status            = 'Processed';
                
                
                if(isset($object['job_id']))
                {
                    $transaction->job_id = $object['job_id'];

                }     

                if(isset($object['account']))
                {
                    $transaction->account_id = $object['account'];

                }

                if(isset($object['client']))
                {
                    $transaction->client_name = $object['client'];
                }

                if(isset($object['contact_no']))
                {
                    $transaction->contact_no = $object['contact_no'];
                }
                
                // dd($transaction);
                $transaction->update();

                $driver = new Driver;

                $driver->name  = $object['driver_name'];

                $driver->save();

                $this->getMaterialRate($transaction);

                $payment = new Payment;

                $payment_info['transaction_id'] =  $transaction->id; 
                $payment_info['amount'] =  $transaction->total_cost; 
                $payment_info['rate']  =  $transaction->material_rate; 
                $payment_info['net_weight']  =  $transaction->net_weight; 
                $payment_info['tax_amount']  =  $this->calculateSurchargeHstTax($transaction)['tax_amount']; 
                $payment_info['surcharge_amount']  =  $this->calculateSurchargeHstTax($transaction)['surcharge_amount']; 

                if(!isset($transaction->client_id) && $transaction->client_group == "Cash Account")
                {
                    $payment_info['mode_of_payment']  =  $object['mode_of_payment']; 

                    if($object['mode_of_payment'] == 'Pass')
                    {
                        $payment_info['pass_no']    =   $object['pass_no'];
                    }

                }
                $payment->storePayment($payment_info);

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
          
// dd($object);
            if(isset($transaction->id))
            {

                if(isset($object['truck_id']))
                {
                    $truck = Truck::find($object['truck_id']);
                   
                    $transaction->client_id = $truck->user->id;
    
                    
                }
                $transaction->added_id = Auth::user()->id;

                $transaction->gross_weight = $object['inweight'];
                $transaction->tare_weight = $object['outweight'];
                $transaction->net_weight = $object['net_weight'];
                
                if($object['net_weight'] < 0)
                {
                    $transaction->operation_type = 'Outbound';
                    
                }
                else
                {
                    $transaction->operation_type = 'Inbound';

                }

                $transaction->material_type_id  = $object['material_type'];

                $transaction->status            = 'Processed';
                
                if(isset($object['job_id']))
                {
                    $transaction->job_id = $object['job_id'];

                }     

                if(isset($object['truck_id']))
                {
                    $transaction->truck_id = $object['truck_id'];

                } 
                if(isset($object['account']))
                {
                    $transaction->account_id = $object['account'];

                }

                if(isset($object['client']))
                {
                    $transaction->client_name = $object['client'];
                }

                if(isset($object['contact_no']))
                {
                $transaction->contact_no = $object['contact_no'];
                }
           
                // dd($transaction);
                $transaction->update();

                // $driver = new Driver;

                // $driver->name  = $object['driver_name'];

                // $driver->save();

                $this->getMaterialRate($transaction);

                // $material_rate =  $transaction->materialType->board_rate;

                // $transaction->material_rate = $material_rate;
                // $transaction->total_cost = $total_price;

                // $transaction->driver_id  = $driver->id;

                $transaction->update();


            }


        return with($transaction);


        });

    }

    public function calculateSurchargeHstTax($transaction)
    {
        $surcharge_hst = new SurchargeHstPercentage;
        $surcharge_hst = $surcharge_hst->getSurchargeHstPer();

        $data = ['tax_amount' => 0 , 'surcharge_amount' => 0];
        
        if(isset($surcharge_hst->id))
        {
            $hst_per = $surcharge_hst->hst_per;

            $data['tax_amount'] = ($hst_per/100) * $transaction->total_cost;

            $surcharge_per = $surcharge_hst->surcharge_per;

            $data['surcharge_amount'] = ($surcharge_per/100) * $transaction->total_cost;
        }
        return $data;
    }

    public function getMaterialRate(Transaction $transaction)
    {
        $material_rate = 0;

        $material_rate_obj = new MaterialRate;
// dd($transaction);
        if(isset($transaction->account_id) && isset($transaction->material_type_id))
        {
           $material_rate =  $material_rate_obj->getMaterialRateByCondition(['material_type_id' => $transaction->material_type_id , 'account_id' => $transaction->account_id]);

           if(isset($material_rate->id))
           {
            $material_rate = $material_rate->rate;

           }

           $total_price = $transaction->net_weight*$material_rate;
        }
        if($transaction->client_group == "Cash Account")
        {
            $material_rate =  $transaction->materialType->board_rate;

            $total_price =  $this->calculateRateBySlab($transaction);

        }

            $transaction->material_rate = $material_rate;
            $transaction->total_cost = $total_price;

            $transaction->update();

        return $material_rate;

    }

    public function calculateRateBySlab(Transaction $transaction) {
     
        $totalPrice = 0;

       $net_weight = $transaction->net_weight*1000;
       $board_rate = $transaction->materialType->board_rate;

       if(isset($transaction->materialType->slab_rate) && $transaction->materialType->slab_rate > 0)
       {
        $slab_rate = $transaction->materialType->slab_rate;
        $slab_weight = $transaction->materialType->slab_weight;
        $totalPrice = $board_rate + ceil(($net_weight - 250) / 50) * $slab_rate;

       }
       else
       {
         $totalPrice = $board_rate +  $transaction->net_weight;

       }


       return $totalPrice;
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

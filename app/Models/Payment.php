<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Payment extends Model
{
    use HasFactory;

    public function storePayment($object)
    {
        return DB::transaction(function() use ($object){

            $payment = new Payment;
            $payment->transaction_id =          $object['transaction_id'];
            $payment->amount         =          $object['amount'];
            $payment->tax_amount    =          $object['tax_amount'];
            $payment->surcharge_amount    =          $object['surcharge_amount'];
            $payment->rate           =          $object['rate'];
            $payment->quantity       =          $object['net_weight'];

            $payment->save();

            return with($payment);
        });

    }
}

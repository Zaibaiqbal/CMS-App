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
            $payment->received_amount         =          $object['received_amount'];
            $payment->tax_amount    =          $object['tax_amount'];
            $payment->surcharge_amount    =          $object['surcharge_amount'];
            $payment->rate           =          $object['rate'];
            $payment->quantity       =          $object['net_weight'];

            if(isset($object['mode_of_payment']))
            {
                $payment->mode_of_payment       =          $object['mode_of_payment'];

            }

            if(isset($object['pass_no']))
            {
                $payment->pass_no       =          $object['pass_no'];

            }

            if(isset($object['no_of_passes']))
            {
                $payment->no_of_passes       =          $object['no_of_passes'];

            }

            if(isset($object['passes_amount']))
            {
                $payment->passes_amount       =         $object['passes_amount'];

            }
            if(isset($object['passes_weight']))
            {
                $payment->passes_weight       =         $object['passes_weight'];

            }
            $payment->save();

            return with($payment);
        });

    }
}

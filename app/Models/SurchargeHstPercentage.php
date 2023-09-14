<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SurchargeHstPercentage extends Model
{
    use HasFactory;

    protected $table = 'surcharge_hst_percentage';

    public function getSurchargeHstPer()
    {
        return SurchargeHstPercentage::first();
    }
    public function storeSurcharge($object)
    {
        return DB::transaction(function() use ($object){

            // dd($object);
            if(isset($object['surcharge_hst']))
            {
                $surcharge_hst = SurchargeHstPercentage::find($object['surcharge_hst']);
                if(isset($surcharge_hst->id))
                {
                    $surcharge_hst->hst_per = $object['hst_per'];
                    $surcharge_hst->surcharge_per = $object['surcharge'];
                    $surcharge_hst->update();
                }

            }
            else
            {
                $surcharge_hst = new SurchargeHstPercentage;
                $surcharge_hst->hst_per = $object['hst_per'];
                $surcharge_hst->surcharge_per = $object['surcharge'];
                $surcharge_hst->save();
            }
     

            return with($surcharge_hst);
        });

    }
}


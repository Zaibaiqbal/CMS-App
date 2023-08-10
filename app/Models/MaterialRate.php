<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialRate extends Model
{
    use HasFactory;

    public function storeMaterialRate($object)
    {
        return DB::transaction(function() use ($object){

            $material_rate = new MaterialRate;

            $material_rate->material_type_id   = $object['material_type_id'];
            $material_rate->rate               = $object['rate'];
            $material_rate->client_id              = $object['client'];

            $material_rate->save();

            return with($material_rate);
        });

    }
}

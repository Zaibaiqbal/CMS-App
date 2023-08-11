<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialRate extends Model
{
    use HasFactory;

    public function getMaterialRateList()
    {
        return MaterialRate::whereHas('client')->whereHas('materialType')->get();
    }

    public function storeMaterialRate($object)
    {
        return DB::transaction(function() use ($object){

            $material_rate = new MaterialRate;
            
            $material_type = new MaterialType;
            $type = $material_type->getMaterialTypeById($object['material_type_id']);

            if(isset($type->id))
            {
                $material_rate->material_type_id   = $object['material_type_id'];
                $material_rate->rate               = $object['rate'];
                $material_rate->client_id              = $object['client'];
    
                $material_rate->save();
            }
          

            return with($material_rate);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialType extends Model
{
    use HasFactory;


    public function getMaterialTypeById($id)
    {
     return MaterialType::where('id',$id)->first();
    }

   public function getMaterialTypeList()
   {
    return MaterialType::get();
   }


   public function storeMaterialType($object)
   {
       return DB::transaction(function() use ($object){

            $material_type = new MaterialType;
        
            $material_type->name = $object['type'];
            $material_type->board_rate = $object['board_rate'];
            $material_type->slab_rate = $object['slab_rate'];
            $material_type->slab_weight = $object['slab_weight'];
            $material_type->weight_break = $object['weight_break'];

            $material_type->save();
                    
           return with($material_type);
       });

   }

}

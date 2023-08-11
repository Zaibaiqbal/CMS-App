<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

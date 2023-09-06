<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateSlab extends Model
{
    use HasFactory;


    public function getRateSlabByWeight($weight = 0)
    {
       return RateSlab::where('start_weight', '<=', $weight)
        ->where(function ($query) use ($weight) {
            $query->where('end_weight', '>=', $weight)
                ->orWhereNull('end_weight');
        })
        ->first();
    }
}

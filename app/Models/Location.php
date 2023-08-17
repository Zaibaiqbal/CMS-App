<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
    use HasFactory;

    public function storeLocation($object)
    {
        return DB::transaction(function() use ($object)
        {

            $category = Category::find($object['category']);

            if(isset($category->id))
            {

                $location = new Location;

                $location->name = $object['name'];
                $location->category_id = $category->id;

                if(isset($object['contact']))
                {
                    $location->contact = $object['contact'];

                }

                $location->address = $object['address'];

                $location->save();
            }

            return with($location);

        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }
}

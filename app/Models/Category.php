<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;

    public function getCategoryList()
    {
        return Category::get();
    }

    public function storeCategory($object)
    {
        return DB::transaction(function() use ($object)
        {

            $category = new Category;

            $category->name = $object['name'];
            $category->save();

            return with($category);

        });
    }

}

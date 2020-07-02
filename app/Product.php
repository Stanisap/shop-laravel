<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    эта функция перегружает контролер, но она работает
//    public function getCategory()
//    {
//        return $category = Category::find($this->category_id);
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

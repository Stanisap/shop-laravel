<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    protected $fillable = [
        'name', 'code', 'description', 'category_id', 'image'
    ];

//    эта функция перегружает контролер, но она работает
//    public function getCategory()
//    {
//        return $category = Category::find($this->category_id);
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot->count)) {
            return $this->price * $this->pivot->count;
        } else {
            return $this->price;
        }
    }
}

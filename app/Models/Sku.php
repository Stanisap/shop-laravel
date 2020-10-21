<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['product_id', 'count', 'price'];

//    Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //    Relations
    public function propertyOptions()
    {
        return $this->belongsToMany(PropertyOption::class, 'sku_property_option')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find($id)
 */
class Sku extends Model
{
    use SoftDeletes;

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

    public function isAvailable()
    {
        return !$this->product->trashed() && $this->count > 0;
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

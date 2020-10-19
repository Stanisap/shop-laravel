<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $all)
 */
class PropertyOption extends Model
{
    use SoftDeletes, Translatable;

    protected $fillable = ['property_id', 'name', 'name_en'];

    //    Relations
    // TODO: check table name and fields
    public function skus()
    {
        return $this->belongsToMany(Sku::class);
    }
}

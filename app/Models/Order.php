<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(\Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store $orderId)
 * @property Sku skus
 */
class Order extends Model
{

    protected $fillable = ['user_id', 'currency_id', 'sum'];

    public function skus()
    {
        return $this->belongsToMany(Sku::class)->withPivot('count', 'price')->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function calculateFullSum()
    {
        $sum = 0;
        foreach ($this->skus()->withTrashed()->get() as $sku) {
            $sum += $sku->getPriceForCount();
        }
        return $sum;
    }

    public function getFullSum()
    {
       $sum = 0;
        foreach ($this->skus as $sku) {
            $sum += $sku->price * $sku->countInOrder;
        }
       return $sum;
    }

    public function saveOrder($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = $this->getFullSum();
        $skus = $this->skus;

        $this->save();

        foreach ($skus as $skuInOrder) {
            $this->skus()->attach($skuInOrder, [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price,
            ]);
        }
        session()->forget('order');
        return true;
    }

    // methods scopes

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

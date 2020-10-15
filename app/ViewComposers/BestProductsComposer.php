<?php


namespace App\ViewComposers;


use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view)
    {
        $bestIdProducts = Order::get()->map->products->flatten()->map->pivot->mapToGroups(function ($pivot) {
            return [$pivot->product_id => $pivot->count];
        })->map->sum()->sortDesc()->take(3)->keys()->toArray();
        $bestProducts = Product::whereIn('id', $bestIdProducts)->get();
        $view->with('bestProducts', $bestProducts);
    }

}
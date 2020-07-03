<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use function Symfony\Component\String\s;

class BasketController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basketPlace()
    {
        return view('order');

    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        return redirect()->route('basket');
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)){
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        return redirect()->route('basket');
    }
}

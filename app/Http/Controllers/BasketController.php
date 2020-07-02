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
        return view('basket');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('order', compact('order'));
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
        $order->products()->attach($productId);

        return view('basket', compact('order'));
    }
}

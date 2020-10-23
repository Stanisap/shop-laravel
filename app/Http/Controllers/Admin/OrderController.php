<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Show the application orders.
     *
     * @return Renderable
     */
    public function index()
    {
        $orders = Order::active()->paginate(10);
        return view('auth.orders.index', compact('orders'));
    }

    /**
     * Shows the application order
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order)
    {
        $skus = $order->skus()->withTrashed()->get();
        return view('auth.orders.show', compact('order', 'skus'));
    }
}

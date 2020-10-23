<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        $orders = Auth::user()->orders()->active()->paginate(10);

        return view('auth.orders.index', compact('orders'));
    }

    /**
     * Shows the application order
     * @param Order $order
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(Order $order)
    {
        if (Auth::user()->orders->contains($order)) {
            $skus = $order->skus()->withTrashed()->get();
            return view('auth.orders.show', compact('order', 'skus'));
        }
        return back();

    }
}

<?php

namespace App\Http\Middleware;

use App\Order;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
            if ($order->products->count() > 0) {
                return $next($request);
            }
        }
        session()->flash('warning', 'Ваша корзина пустая!');
        return redirect()->route('index');
    }
}

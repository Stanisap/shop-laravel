<?php

namespace App\Http\Middleware;

use App\Models\Order;
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
        if (!is_null($orderId) && Order::getFullSum() > 0) {
            return $next($request);
        }
        session()->flash('warning', 'Ваша корзина пустая!');
        return redirect()->route('index');
    }
}

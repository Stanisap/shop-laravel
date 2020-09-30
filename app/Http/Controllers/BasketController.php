<?php

namespace App\Http\Controllers;


use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BasketController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    /**
     * @return Application|Factory|View
     */
    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', 'Товар не доступен в полном объеме');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function orderConfirm(Request $request)
    {
        if ((new Basket())->saveOrder($request->name, $request->phone)) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Товар не доступен в полном объеме');
        }
        Order::eraseOrderSum();
        return redirect()->route('index');
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', 'Добавлен товар ' . $product->name);
        } else {
            session()->flash('warning', 'Товар ' . $product->name . ' в большем кол-ве не доступен');
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);
        session()->flash('warning', 'Удален товар ' . $product->name);
        return redirect()->route('basket');
    }
}

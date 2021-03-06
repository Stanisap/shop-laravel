<?php

namespace App\Http\Controllers;


use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', __('basket.messages.not_available'));
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function orderConfirm(Request $request)
    {
        $email = (Auth::check()) ? Auth::user()->email : $request->email;
        if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash('success', __('basket.messages.confirmed_order'));
        } else {
            session()->flash('warning', __('basket.messages.not_available'));
        }
        return redirect()->route('index');
    }

    public function basketAdd(Sku $sku)
    {

        $result = (new Basket(true))->addSku($sku);

        if ($result) {
            session()->flash('success', $sku->product->__('name') . __('basket.messages.item_added'));
        } else {
            session()->flash('warning', $sku->product->__('name') . __('basket.messages.this_not_available'));
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Sku $sku)
    {
        (new Basket())->removeSku($sku);
        session()->flash('warning', $sku->product->__('name') . __('basket.messages.item_deleted'));
        return redirect()->route('basket');
    }
}

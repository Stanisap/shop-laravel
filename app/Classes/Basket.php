<?php


namespace App\Classes;


use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
   protected $order;

    /**
     * Basket constructor.
     * @param bool $createOrder
     */
    public function __construct($createOrder = false)
    {
        $order = session('order');

        if (is_null($order) && $createOrder) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;

            $this->order = new Order($data);
            session(['order' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false)
    {
        $products = collect([]);
        foreach ($this->order->products as $productOrder) {
            $product = Product::find($productOrder->id);
            if ($productOrder->countInOrder > $product->count) {
                return false;
            }
            if ($updateCount) {
                $product->count -= $productOrder->countInOrder;
                $products->push($product);
            }
        }
        if ($updateCount) {
            $products->map->save();
        }
        return true;
    }


    public function saveOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(true)) {
            return false;
        }
        $result = $this->order->saveOrder($name, $phone);
        Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
        return $result;
    }

    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $productInOrder = $this->order->products->where('id', $product->id)->first();
            if ($productInOrder->countInOrder < 2) {
                $this->order->products->pop($product);;
            } else {
                $productInOrder->countInOrder--;
            }
        }
    }

    public function addProduct(Product $product)
    {
        if ($this->order->products->contains($product)) {
            $productInOrder = $this->order->products->where('id', $product->id)->first();
            if ($productInOrder->countInOrder >= $product->count) {
                return false;
            }
            $productInOrder->countInOrder++;
        } else {
            if ($product->count == 0) {
                return false;
            }
            $product->countInOrder = 1;
            $this->order->products->push($product);
        }
        return true;
    }
}

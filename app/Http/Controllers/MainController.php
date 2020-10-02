<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * The action for a main page of the site
     * @param ProductsFilterRequest $request
     * @return Application|Factory|View
     */
    public function index(ProductsFilterRequest $request)
    {
        $productQuery = Product::with('category');

        if ($request->filled('price_from')) {
            $productQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $productQuery->$field();
            }
        }

        $products = $productQuery->paginate(6);
        return view('index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    /**
     * @param ProductsFilterRequest $request
     * @param $code
     * @return Application|Factory|View
     */
    public function category(ProductsFilterRequest $request, $code)
    {
        $category = Category::where('code', $code)->first();

        $productQuery = $category->products()->with('category');
        if ($request->filled('price_from')) {
            $productQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $productQuery->where($field, 1);
            }
        }

        $products = $productQuery->paginate(6);

        return view('category', compact('products', 'category'));
    }

    /**
     * @param $category
     * @param $productCode
     * @return Application|Factory|View
     */
    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view('product', compact('product'));
    }

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', "Спасибо мы свяжемся с Вами при поступлении $product->name");
    }

}

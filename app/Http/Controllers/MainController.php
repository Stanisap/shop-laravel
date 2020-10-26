<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\App;
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

        $skusQuery = Sku::with('product', 'product.category');

        if ($request->filled('price_from')) {
            $skusQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $skusQuery->where('price', '<=', $request->price_to);
        }
        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $skusQuery->whereHas('product', function ($query) use ($field) {
                    $query->$field();
                });
            }
        }
        $skus = $skusQuery->paginate(6);
        return view('index', compact('skus'));
    }

    /**
     * @return Application|Factory|View
     */
    public function categories()
    {
        return view('categories');
    }

    /**
     * @param ProductsFilterRequest $request
     * @param $code
     * @return Application|Factory|View
     */
    public function category(ProductsFilterRequest $request, $code)
    {
        $category = Category::where('code', $code)->first();

//        $productQuery = $category->products()->with('category');
//        if ($request->filled('price_from')) {
//            $productQuery->where('price', '>=', $request->price_from);
//        }
//        if ($request->filled('price_to')) {
//            $productQuery->where('price', '<=', $request->price_to);
//        }
//        foreach (['hit', 'new', 'recommend'] as $field) {
//            if ($request->has($field)) {
//                $productQuery->where($field, 1);
//            }
//        }
//
//        $products = $productQuery->paginate(6);
//        dd($category->products->map->skus, $products->getCollection()->map->skus->flatten());
        return view('category', compact('category'));
    }

    /**
     * @param $categoryCode
     * @param $productCode
     * @param Sku $sku
     * @return Application|Factory|View
     */
    public function sku($categoryCode, $productCode, Sku $sku)
    {
        if ($sku->product->code != $productCode) {
            abort(404, 'Product not found!');
        }
        if ($sku->product->category->code != $categoryCode) {
            abort(404, 'Category not found!');
        }
        //$product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view('product', compact('sku'));
    }

    public function subscribe(SubscriptionRequest $request, Sku $sku)
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $sku->id,
        ]);

        return redirect()->back()->with('success', __('main.m_subscribe') . $sku->name);
    }

    public function changeLocale($locale)
    {
        $availableLocale = ['ru', 'en'];
        if (!in_array($locale, $availableLocale)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }
}

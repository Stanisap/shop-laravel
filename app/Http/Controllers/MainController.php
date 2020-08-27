<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductsFilterRequest;
use App\Product;

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
        $productQuery = Product::query();

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

        $productQuery = $category->products()->getQuery();
        //dd($request->all());
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

        $products = $productQuery->paginate(3);

        return view('category', compact('category', 'products'));
    }

    /**
     * @param $category
     * @param null $product
     * @return Application|Factory|View
     */
    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->first();
        return view('product', compact('product'));
    }

}

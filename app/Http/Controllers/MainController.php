<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * The action for a main page of the site
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    /**
     * @param $code
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        //$products = Product::where('category_id', $category->id)->get();
        return view('category', compact('category'));
    }

    /**
     * @param $category
     * @param null $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->first();
        return view('product', compact('product'));
    }

}

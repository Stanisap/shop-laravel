<?php

namespace App\Http\Controllers;

use App\Category;
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
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::get();
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
     * @param $code
     * @return Application|Factory|View
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
     * @return Application|Factory|View
     */
    public function product($category, $product = null)
    {
        $product = Product::where('code', $product)->first();
        return view('product', compact('product'));
    }

}

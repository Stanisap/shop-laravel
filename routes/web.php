<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::get('/locale/{locale}', 'MainController@changeLocale')->name('locale');

Route::get('/currency/{currencyCode}', 'MainController@changeCurrency')->name('currency');



Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');

Route::middleware(['set_locale'])->group(function () {
    Route::get('/reset', 'ResetController@reset')->name('reset');
    Route::middleware(['auth'])->group(function () {
        // the routes for customers
        Route::group([
            'namespace' => 'Person',
            'prefix' => 'person',
            'as' => 'person.',
        ], function () {
            Route::get('/orders', 'OrderController@index')->name('orders.index');
            Route::get('/orders/{order}', 'OrderController@show')->name('order.show');
        });
        //  the routes for the administrations
        Route::group([
            'namespace' => 'Admin',
            'prefix' => 'admin',
        ], function () {
            Route::group(['middleware' => 'is_admin'], function () {
                Route::get('/orders', 'OrderController@index')->name('home');
                Route::get('/orders/{order}', 'OrderController@show')->name('show-order');
            });
            Route::resource('/categories', 'CategoryController');
            Route::resource('/products', 'ProductController');
            Route::resource('/products/{product}/skus', 'SkuController');
            Route::resource('/properties', 'PropertyController');
            Route::resource('/properties/{property}/property-options', 'PropertyOptionController');
        });
    });

    Route::get('/', 'MainController@index')->name('index');
    Route::get('/categories', 'MainController@categories')->name('categories');
    Route::post('/subscription/{sku}', 'MainController@subscribe')->name('subscription');

    Route::group(['prefix' => 'basket'], function () {
        Route::post('/add/{sku}', 'BasketController@basketAdd')->name('basket-add');

        Route::group(['middleware' => 'basket_not_empty'], function () {
            Route::get('/', 'BasketController@basket')->name('basket');
            Route::post('/remove/{sku}', 'BasketController@basketRemove')->name('basket-remove');
            Route::get('/place', 'BasketController@basketPlace')->name('basket-place');
            Route::post('/place', 'BasketController@orderConfirm')->name('order-confirm');
        });
    });

    Route::get('/{category}', 'MainController@category')->name('category');
    Route::get('/{category}/{product?}/{sku}', 'MainController@sku')->name('sku');
});

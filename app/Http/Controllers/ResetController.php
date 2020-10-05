<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');

        foreach (['categories',  'products'] as $folder) {
            // deletes an old folder in /storage/app/public/categories|products
            Storage::deleteDirectory($folder);
            // creates a new folder in /storage/app/public/categories|products
            Storage::makeDirectory($folder);
            // adds all images in a new created folder in /storage/app/public/categories|products
            // from /resources/images/categories|products
            $files = Storage::disk('reset')->files($folder);
            foreach ($files as $file) {
                Storage::put($file, Storage::disk('reset')->get($file));
            }
        }
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            session()->forget('orderId');
            session()->forget('full_order_sum');
        }
        session()->flash('success', __('main.m_reset'));

        return redirect()->route('index');
    }
}

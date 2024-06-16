<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featurePrds = Product::where('noibat_sp', '1')->limit(8)->get();
        $iphone = Product::where('cat_id', '1')->limit(8)->get();
        $samsung = Product::where('cat_id', '2')->limit(8)->get();
        $oppo = Product::where('cat_id', '4')->limit(8)->get();
        $xiaomi = Product::where('cat_id', '4')->limit(8)->get();
        $latestPrds = Product::orderBy('id','desc')->limit(8)->get();
        // dd($featurePrds);
        return view('client.index', [
            'featurePrds' => $featurePrds, 
            'iphone' => $iphone, 
            'samsung' => $samsung, 
            'oppo' => $oppo, 
            'xiaomi' => $xiaomi,
            'latestPrds'=> $latestPrds
        ]);
    }
    public function cart(){
        return view('client.cart');
    }
}

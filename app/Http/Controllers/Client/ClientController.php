<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class ClientController extends Controller
{
    public function index()
    {
        $featurePrds = Product::where('noibat_sp', '1')->limit(8)->get();
        $iphone = Product::where('cat_id', '1')->limit(8)->get();
        $samsung = Product::where('cat_id', '2')->limit(8)->get();
        $oppo = Product::where('cat_id', '4')->limit(8)->get();
        $xiaomi = Product::where('cat_id', '4')->limit(8)->get();
        $latestPrds = Product::orderBy('id', 'desc')->limit(8)->get();

        return view('client.index', [
            'featurePrds' => $featurePrds,
            'iphone' => $iphone,
            'samsung' => $samsung,
            'oppo' => $oppo,
            'xiaomi' => $xiaomi,
            'latestPrds' => $latestPrds
        ]);
    }

    public function cart(CartHelper $cart)
    {
        $products = $cart->get();
        $totalQuantity = $cart->getTotalQuantity();
        $totalPrice = $cart->getTotalPrice();
        return view('client.cart', ['products' => $products,'totalQuantity'=> $totalQuantity,'totalPrice'=> $totalPrice]);
    }

    public function addToCart(Request $request, CartHelper $cart)
    {
        $product = Product::find($request->product_id);
        $cart->add($product);
        $totalQuantity = $cart->getTotalQuantity();
        return response()->json(['totalQuantity'=>$totalQuantity]);
    }

    public function delItem(Request $request)
    {
        if ($request->ajax() && $request->isMethod('delete') && $request->has('product_id')) {
            $productId = $request->input('product_id');

            $cart = Session::get('cart.items', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);

                Session::put('cart.items', $cart);
                $items = Session::get('cart.items', []);
                $totalQuantity = 0;
                $totalPrice = 0;
                foreach ($items as $item) {
                    $totalQuantity += $item['soluong_sp'];
                    $totalPrice += $item['soluong_sp'] * $item['gia_sp'];
                }
                return response()->json(['success' => true, 'message' => 'Product removed from cart','totalQuantity'=>$totalQuantity,'totalPrice'=>$totalPrice]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found in cart']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid request']);
        }
    }


    public function update(Request $request,CartHelper $cart)
{
    $updateData = json_decode($request->input('updateData'));
    if (!isEmpty($updateData)) {
        dd('rỗng');
    }else{
        foreach($updateData as $key => $item) {
            $productId = $item->productId;
            $quantity = $item->quantity;
            $cart->update($productId, $quantity);
        }
        return redirect()->route('cart.index')->with('success','cập nhật giỏ hàng thành công');
    }
}

}

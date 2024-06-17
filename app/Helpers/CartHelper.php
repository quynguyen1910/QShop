<?php
namespace App\Helpers;

use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Session;

class CartHelper
{
    private $items = [];
    private $total_quantity = 0;
    private $total_gia_sp = 0;

    public function __construct()
    {
        $this->items = Session::get('cart.items', []);
        $this->total_quantity = Session::get('cart.total_quantity', 0);
        $this->total_gia_sp = Session::get('cart.total_gia_sp', 0);
    }

    // Lấy danh sách sản phẩm
    public function get()
    {
        return $this->items;
    }

    // Tổng số lượng sản phẩm
    public function getTotalQuantity()
    {
        $this->total_quantity = 0; // Reset total_quantity to recalculate
        foreach ($this->items as $key => $item) {
            $this->total_quantity += $item['soluong_sp'];
        }
        $this->updateSession(); // Update session after calculating total quantity
        return $this->total_quantity;
    }

    // Tổng giá sản phẩm
    public function getTotalPrice()
    {
        $this->total_gia_sp = 0; // Reset total_gia_sp to recalculate
        foreach ($this->items as $key => $item) {
            $this->total_gia_sp += $item['soluong_sp'] * $item['gia_sp'];
        }
        $this->updateSession(); // Update session after calculating total price
        return $this->total_gia_sp;
    }

    // Thêm sản phẩm vào giỏ hàng
public function add($product, $quantity = 1)
{
    // Kiểm tra xem số lượng được thêm vào có hợp lệ hay không
    if (!is_numeric($quantity) || $quantity <= 0) {
        return; // Nếu không hợp lệ, không thêm vào giỏ hàng
    }

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    if (array_key_exists($product->id, $this->items)) {
        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
        $this->items[$product->id]['soluong_sp'] += $quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm sản phẩm vào giỏ hàng
        $item = [
            'id' => $product->id,
            'anh_sp' => $product->anh_sp,
            'ten_sp' => $product->ten_sp,
            'gia_sp' => $product->giakm_sp > 0 ? $product->giakm_sp : $product->gia_sp,
            'soluong_sp' => $quantity,
        ];
        $this->items[$product->id] = $item;
    }

    // Sau khi thay đổi giỏ hàng, cập nhật lại total_quantity và total_gia_sp
    $this->getTotalQuantity();
    $this->getTotalPrice();
}



    //cập nhật sản phẩm
//cập nhật sản phẩm
public function update($productId, $quantity = 1)
{
    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (array_key_exists($productId, $this->items)) {
        if (is_numeric($quantity) && $quantity > 0) {
            $this->items[$productId]['soluong_sp'] = $quantity;

            // Sau khi cập nhật số lượng sản phẩm, cần cập nhật lại total_quantity và total_gia_sp
            $this->total_quantity = 0; // Reset total_quantity to recalculate
            $this->total_gia_sp = 0; // Reset total_gia_sp to recalculate

            // Tính lại tổng số lượng và tổng giá sản phẩm từ các sản phẩm trong giỏ hàng
            foreach ($this->items as $key => $item) {
                $this->total_quantity += $item['soluong_sp'];
                $this->total_gia_sp += $item['soluong_sp'] * $item['gia_sp'];
            }

            // Cập nhật lại Session sau khi tính toán xong
            $this->updateSession();
        }
    }
}


    // Cập nhật session
    private function updateSession()
    {
        Session::put('cart.items', $this->items);
        Session::put('cart.total_quantity', $this->total_quantity);
        Session::put('cart.total_gia_sp', $this->total_gia_sp);
    }

}

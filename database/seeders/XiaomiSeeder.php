<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use Illuminate\Support\Str;
class XiaomiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mảng tên file ảnh mới
        $imageNames = [
          '13t.jpg',
            'c65-1.jpg',
            'k16yellowzhengmianfront.jpg',
            'note-11-pro-5g-2.jpg',
            'poco-x6-5g.jpg',
            'redmi-a2-gray-1.jpg',
            'redmi-a2-plus.jpg',
            'redmi-a3.jpg',
            'redmi-note-13-pro-plus-5g.jpg',
            'redmi-note-13-pro.jpg',
            'redmi-note-13.jpg',
            'redminote12-0.jpg',
            'redminote12pro5g-0.jpg',
            'remi12-a.jpg',
            'thumb-xiaomi-13-lite.jpg',
            'xiaomi-14-ultra.jpg',
            'xiaomi-14.jpg',
            'xiaomi-redmi-13c-18.jpg',
        ];

        // Mảng tên sản phẩm tương ứng
        $productNames = [
            'Xiaomi 13T',
            'Xiaomi C65',
            'K16 Yellow Zheng Mian Front',
            'Note 11 Pro 5G',
            'Poco X6 5G',
            'Redmi A2 Gray',
            'Redmi A2 Plus',
            'Redmi A3',
            'Redmi Note 13 Pro Plus 5G',
            'Redmi Note 13 Pro',
            'Redmi Note 13',
            'Redmi Note 12',
            'Redmi Note 12 Pro 5G',
            'Remi 12 A',
            'Thumb Xiaomi 13 Lite',
            'Xiaomi 14 Ultra',
            'Xiaomi 14',
            'Xiaomi Redmi 13C 18',
        ];

        // Đảm bảo số lượng tên sản phẩm và tên file ảnh khớp nhau
        if (count($imageNames) !== count($productNames)) {
            throw new \Exception("Số lượng tên sản phẩm và tên file ảnh không khớp.");
        }

        // Tạo dữ liệu sản phẩm từ mảng tên sản phẩm và tên file ảnh
        for ($i = 0; $i < count($imageNames); $i++) {
            $productData = [
                'ten_sp' => $productNames[$i],
                'slug' => Str::slug($productNames[$i]),
                'anh_sp' => 'products/' . $imageNames[$i],
                'gia_sp' => rand(10000000, 30000000), // Giá ngẫu nhiên từ 10,000,000 đến 30,000,000 VNĐ
                'soluong_sp' => rand(0, 99), // Số lượng ngẫu nhiên từ 0 đến 99
                'tinhtrang_sp' => true,
                'noibat_sp' => false,
                'phukien_sp' => '',
                'khuyenmai_sp' => '',
                'mota_sp' => 'Mô tả sản phẩm ' . $productNames[$i],
                'cat_id' => 5, // Danh mục sản phẩm có id là 2
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tạo sản phẩm trong database
            Product::create($productData);
        }
    }
}

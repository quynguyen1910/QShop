<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mảng tên file ảnh
        $imageNames = [
            '13-removebg-preview.jpg',
            '14-removebg-preview.jpg',
            '14plus-removebg-preview.jpg',
            'iphone-11-black-2-up-vertical-us-en-screen-1.jpg',
            'iphone-11-white-2-up-vertical-us-en-screen-1.jpg',
            'iphone-12-finish-select-202207-green-removebg-preview.jpg',
            'iphone-15-pink-pure-back-iphone-15-pink-pure-front-2up-screen-usen.jpg',
            'iphone-15-plus-blue-pure-back-iphone-15-plus-blue-pure-front-2up-screen-usen.jpg',
            'iphone-15-pro-finish-select-202309-6-7inch-naturaltitanium-removebg-preview-1.jpg',
            'iphone-15-pro-max-natural-titanium-pure-back-iphone-15-pro-max-natural-titanium-pure-front-2up-screen-usen-1.jpg',
        ];

        // Mảng tên sản phẩm tương ứng
        $productNames = [
            'iPhone 13',
            'iPhone 14',
            'iPhone 14 Plus',
            'iPhone 11 Black',
            'iPhone 11 White',
            'iPhone 12 Green',
            'iPhone 15 Pink Pure',
            'iPhone 15 Plus Blue Pure',
            'iPhone 15 Pro Natural Titanium',
            'iPhone 15 Pro Max Natural Titanium',
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
                'soluong_sp' => rand(0,99),
                'tinhtrang_sp' => true,
                'noibat_sp' => false,
                'phukien_sp' => '',
                'khuyenmai_sp' => '',
                'mota_sp' => 'Mô tả sản phẩm ' . $productNames[$i],
                'cat_id' => 1, // Thay đổi tùy theo danh mục sản phẩm
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tạo sản phẩm trong database
            Product::create($productData);
        }
    }
}

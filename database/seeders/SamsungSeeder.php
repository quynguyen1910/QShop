<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use Illuminate\Support\Str;
class SamsungSeeder extends Seeder
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
            'a25-3.jpg',
            'a35-2.jpg',
            'a55-1.jpg',
            'm34.jpg',
            's24-plus-tim.jpg',
            's24-ultra-vang_638409930027889246.jpg',
            'samsung-galaxy-s23-fe-1.jpg',
            'samsung-galaxy-s23-fe-2.jpg',
            'samsung-galaxy-s23-ultra.jpg',
            'samsung-galaxy-s24-1.jpg',
            'z-flip5-kem.jpg',
            'z-flip5-tim.jpg',
            'z-fold5-3.jpg',
            'z-fold5-4.jpg',
        ];

        // Mảng tên sản phẩm tương ứng
        $productNames = [
            'Product A25',
            'Product A35',
            'Product A55',
            'Product M34',
            'Product S24 Plus Tim',
            'Product S24 Ultra Vang',
            'Samsung Galaxy S23 Tim FE',
            'Samsung Galaxy S23 Den FE',
            'Samsung Galaxy S23 Ultra',
            'Samsung Galaxy S24',
            'Product Z Flip 5 Kem',
            'Product Z Flip 5 Tim',
            'Product Z Fold 5 Tim',
            'Product Z Fold 5 Trang',
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
                'cat_id' => 2, // Danh mục sản phẩm có id là 2
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tạo sản phẩm trong database
            Product::create($productData);
        }
    }
}

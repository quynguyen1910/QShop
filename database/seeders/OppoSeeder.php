<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use Illuminate\Support\Str;
class OppoSeeder extends Seeder
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
            'a58-5.jpg',
            'a78-2.jpg',
            'file_list.txt',
            'image-removebg-preview-16.jpg',
            'image-removebg-preview-18.jpg',
            'image-removebg-preview-2.jpg',
            'image-removebg-preview-25.jpg',
            'image-removebg-preview.jpg',
            'oppo-find-n3-ad.jpg',
            'oppo-find-n3-flip.jpg',
            'reno11-f-1.jpg',
            'thumb-xanh.jpg',
            'tim-n-flip.jpg',
        ];

        // Mảng tên sản phẩm tương ứng
        $productNames = [
            'Product A58',
            'Product A78',
            'Product File List',
            'Product Image 16',
            'Product Image 18',
            'Product Image 2',
            'Product Image 25',
            'Product Image',
            'Oppo Find N3 Ad',
            'Oppo Find N3 Flip',
            'Reno 11 F',
            'Thumb Xanh',
            'Tim N Flip',
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
                'cat_id' => 4, // Danh mục sản phẩm có id là 2
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Tạo sản phẩm trong database
            Product::create($productData);
        }
    }
}

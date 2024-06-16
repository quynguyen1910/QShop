<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra và xử lý tập tin đã tải lên
        if ($request->hasFile('anh_sp')) {
            $uploadedFilesPaths = [];

            // Lặp qua từng file trong mảng anh_sp
            foreach ($request->file('anh_sp') as $file) {
                // Lấy đường dẫn thực của file tải lên
                $filePath = $file->getRealPath();

                // Lấy tên gốc của file
                $fileName = $file->getClientOriginalName();

                // Upload file lên Cloudinary vào thư mục 'products' với tên là tên gốc của file
                $uploadedFile = Cloudinary::upload($filePath, [
                    'folder' => 'products',
                    'public_id' => pathinfo($fileName, PATHINFO_FILENAME), // Sử dụng tên gốc của file làm public_id
                ])->getSecurePath();

                // Lưu đường dẫn đã upload vào mảng
                $uploadedFilesPaths[] = $uploadedFile;
            }

            // Trả về đường dẫn các file đã upload
            return $uploadedFilesPaths;
        }

        // Xử lý khi không có tập tin được tải lên
        return 'Không có tập tin được tải lên.';
    }
}

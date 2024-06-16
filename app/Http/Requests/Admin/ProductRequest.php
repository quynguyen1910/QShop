<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function prepareForValidation()
    {
        // Merge 'slug' field with the slug of 'ten_sp'
        $this->merge([
            'slug' => Str::slug($this->ten_sp),
        ]);

        // xử lý hình ảnh
        if ($this->hasFile('upload_sp')) {
            $file = $this->file('upload_sp');

            // Create new file name using current time and original file name
            $newFileName = time() . '_' . $file->getClientOriginalName();

            // Upload file to Cloudinary in 'products' folder with new file name
            $uploadedFile = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'products',
                'public_id' => pathinfo($newFileName, PATHINFO_FILENAME),
            ])->getSecurePath();

            // Extract the path to match your desired format
            $parsedUrl = parse_url($uploadedFile, PHP_URL_PATH);
            $path = ltrim($parsedUrl, '/');
            $path = substr($path, strpos($path, 'products/'));

            // Merge the new path into the request
            $this->merge([
                'anh_sp' => $path,
            ]);
        }
    }

    public function rules()
    {
        return [
            'ten_sp' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $this->product,
            'anh_sp' => 'nullable|string',
            'upload_sp' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
            'gia_sp' => 'required|numeric|min:0',
            'giakm_sp' => 'nullable|numeric|min:0',
            'soluong_sp' => 'required|integer|min:0',
            'tinhtrang_sp' => 'required|boolean',
            'noibat_sp' => 'required|boolean',
            'phukien_sp' => 'nullable|string',
            'khuyenmai_sp' => 'nullable|string',
            'mota_sp' => 'nullable|string|max:10000',
            'cat_id' => 'required|exists:categories,id', // Yêu cầu cat_id tồn tại trong bảng categories
        ];
    }

    public function messages()
    {
        return [
            'ten_sp.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_sp.max' => 'Tên sản phẩm không được vượt quá :max ký tự.',
            'slug.required' => 'Tên sản phẩm là bắt buộc.',
            'slug.unique' => 'Tên sản phẩm đã tồn tại.',
            'upload_sp.file' => 'Upload sản phẩm phải là một tệp tin.',
            'upload_sp.mimes' => 'Upload sản phẩm phải có định dạng: jpeg, png, jpg',
            'upload_sp.max' => 'Upload sản phẩm không được vượt quá 2048 KB.',
            'gia_sp.required' => 'Giá sản phẩm là bắt buộc.',
            'gia_sp.numeric' => 'Giá sản phẩm phải là số.',
            'gia_sp.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'giakm_sp.numeric' => 'Giá khuyến mãi phải là số.',
            'giakm_sp.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'soluong_sp.required' => 'Số lượng sản phẩm là bắt buộc.',
            'soluong_sp.integer' => 'Số lượng sản phẩm phải là số nguyên.',
            'soluong_sp.min' => 'Số lượng sản phẩm phải lớn hơn hoặc bằng 1.',
            'tinhtrang_sp.required' => 'Tình trạng sản phẩm là bắt buộc.',
            'tinhtrang_sp.boolean' => 'Tình trạng sản phẩm phải là true hoặc false.',
            'noibat_sp.required' => 'Trường nổi bật sản phẩm là bắt buộc.',
            'noibat_sp.boolean' => 'Trường nổi bật sản phẩm phải là true hoặc false.',
            'phukien_sp.string' => 'Phụ kiện sản phẩm phải là chuỗi.',
            'khuyenmai_sp.string' => 'Khuyến mãi sản phẩm phải là chuỗi.',
            'mota_sp.max' => 'Mô tả sản phẩm không được vượt quá :max ký tự.',
            'cat_id.required' => 'Danh mục sản phẩm là bắt buộc.',
            'cat_id.exists' => 'Danh mục sản phẩm không tồn tại.',
        ];
    }

    public function validated()
    {
        $validated = $this->validator->validated();

        // Xử lý nội dung của mota_sp bằng HTML Purifier
        if (isset($validated['mota_sp'])) {
            $validated['mota_sp'] = Purifier::clean($validated['mota_sp']);
        }

        return $validated;
    }
}

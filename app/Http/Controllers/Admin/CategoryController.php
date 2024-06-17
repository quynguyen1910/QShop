<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $recordsPerPage = $request->input('records_per_page', 5);
        $isDel = $request->input('status', '1');
        $categories = null;

        if ($isDel === '0') {
            $categories = Category::onlyTrashed()->orderBy('id', 'desc')->paginate($recordsPerPage);
        } else {
            $categories = Category::whereNull('parent_id')->with('childrenRecursive')->orderBy('id', 'desc')->paginate($recordsPerPage);
        }

        // Xử lý danh mục đệ qui cho từng trang của phân trang
        $nestedCategories = Category::getNestedCategories($categories);

        return response()->view('admin.category.index', [
            'categories' => $nestedCategories,
            'pagination' => $categories, // Giữ lại đối tượng phân trang để hiển thị phân trang
            'recordsPerPage' => $recordsPerPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = null;
        $categories = Category::whereNull('parent_id')->orderBy('id', 'desc')->with('childrenRecursive')->get();
       
        $nestedCategories = Category::getNestedCategories($categories);
        // dd($nestedCategories);
        return view('admin.category.create', ['categories' => $nestedCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // Lấy dữ liệu đã được xác thực từ request
        $data = $request->validated();

        // Tạo slug từ ten_dm
        $data['slug'] = Str::slug($data['ten_dm']);

        // Lưu danh mục mới vào cơ sở dữ liệu
        Category::create($data);

        // Chuyển hướng về trang danh sách danh mục với thông báo thành công
        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = Category::findOrFail($category);
        $categories = null;
        $categories = Category::whereNull('parent_id')->orderBy('id', 'desc')->with('childrenRecursive')->get();
        $nestedCategories = Category::getNestedCategories($categories);
        return view('admin.category.edit', ['category' => $category, 'categories' => $nestedCategories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validatedData = $request->validated();

        // Cập nhật slug từ tên danh mục
        $validatedData['slug'] = Str::slug($validatedData['ten_dm']);

        // Cập nhật các trường thông tin của danh mục
        $category->update($validatedData);

        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Thực hiện soft delete cho category
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được xóa thành công.');
    }


    public function restore($category)
{
    // Tìm bản ghi đã soft deleted
    $category = Category::onlyTrashed()->findOrFail($category);

    // Khôi phục bản ghi
    $category->restore();

    return redirect()->route('admin.category.index')
                     ->with('success', 'Đã khôi phục danh mục thành công.');
}
}

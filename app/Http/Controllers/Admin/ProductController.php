<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;




class ProductController extends Controller
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
        $products = null;
        if ($isDel === '0') {
        $products = Product::orderBy('id', 'desc')->onlyTrashed()->paginate($recordsPerPage);
        }else {
        $products = Product::orderBy('id', 'desc')->paginate($recordsPerPage);
        }
        return response()->view("admin.product.index",['products' => $products, 'recordsPerPage' => $recordsPerPage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->orderBy('id', 'desc')->with('childrenRecursive')->get();
        $nestedCategories = Category::getNestedCategories($categories);
        return view('admin.product.create',['categories'=> $nestedCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // Lấy tất cả dữ liệu đã được xác thực từ request
        $validatedData = $request->validated();

        // Chuẩn bị dữ liệu để tạo sản phẩm mới
        $productData = [
            'ten_sp' => $validatedData['ten_sp'],
            'slug' => $validatedData['slug'],
            'anh_sp' => $validatedData['anh_sp'] ?? 'products/preview-phone.png',
            'gia_sp' => $validatedData['gia_sp'],
            'giakm_sp' => $validatedData['giakm_sp'] ?? null,
            'soluong_sp' => $validatedData['soluong_sp'],
            'tinhtrang_sp' => $validatedData['tinhtrang_sp'],
            'noibat_sp' => $validatedData['noibat_sp'],
            'phukien_sp' => $validatedData['phukien_sp'] ?? null,
            'khuyenmai_sp' => $validatedData['khuyenmai_sp'] ?? null,
            'mota_sp' => $validatedData['mota_sp'] ?? null,
            'cat_id' => $validatedData['cat_id'],
        ];

        // Tạo bản ghi mới trong bảng products
        $product = Product::create($productData);

        // Trả về phản hồi hoặc điều hướng người dùng tới trang khác
        return redirect()->route('admin.product.index')->with('success', 'Tạo mới sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
                $categories = Category::whereNull('parent_id')->orderBy('id', 'desc')->with('childrenRecursive')->get();
        $nestedCategories = Category::getNestedCategories($categories);

        $product = Product::find($product);
        return view('admin.product.edit',['categories'=> $nestedCategories,'product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {

    // Lấy dữ liệu đã được xác thực
    $validated = $request->validated();

    // Tìm sản phẩm dựa trên ID
    $product = Product::find($product);

    // Kiểm tra nếu sản phẩm tồn tại
    if (!$product) {
        session()->flash('error','không tìm thấy sản phẩm');
        return redirect()->route('admin.product.index');
    }

    // Cập nhật các thuộc tính của sản phẩm với dữ liệu đã được xác thực
    $product->ten_sp = $validated['ten_sp'];
    $product->slug = $validated['slug'];
    if (isset($validated['anh_sp'])) {
        $product->anh_sp = $validated['anh_sp'];
    }
    $product->gia_sp = $validated['gia_sp'];
    $product->giakm_sp = $validated['giakm_sp'] ?? null; // Giá khuyến mãi có thể là null
    $product->soluong_sp = $validated['soluong_sp'];
    $product->tinhtrang_sp = $validated['tinhtrang_sp'];
    $product->noibat_sp = $validated['noibat_sp'];
    $product->phukien_sp = $validated['phukien_sp'] ?? null; // Phụ kiện có thể là null
    $product->khuyenmai_sp = $validated['khuyenmai_sp'] ?? null; // Khuyến mãi có thể là null
    $product->mota_sp = $validated['mota_sp'] ?? null; // Mô tả có thể là null
    $product->cat_id = $validated['cat_id'];

    $product->save();

    // Trả về phản hồi sau khi cập nhật thành công
    session()->flash('success','Cập nhật thành công sản phẩm: '.$validated['ten_sp']);
    return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success','Xóa sản phẩm thành công:'. $product->ten_sp);
        return redirect()->route('admin.product.index');
    }
    public function restore(Product $product){}
}

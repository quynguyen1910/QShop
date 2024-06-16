@extends('admin.shared.layouts.master-layout')
@section('title')
    Product-edit
@endsection

@push('ct-style')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <style>
        .product-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
            padding: 0.5rem;
        }

        .preview-image {
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
        }

        .preview-image img {
            max-width: 100%;
            /* Đảm bảo ảnh không vượt quá khung chứa */
            height: auto;
            margin-top: 10px;
        }
    </style>
@endpush

@section('main')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="m-auto shadow p-3 mt-3">
            <h1 class="text-uppercase text-center">Chỉnh sửa sản phẩm</h1>
            @if ($errors->any())
                <div class="alert alert-danger text-uppercase text-center">
                    Kiểm tra lại dữ liệu
                </div>
            @endif
            <hr>
            <form enctype="multipart/form-data" class="product-form" method="POST" action="{{ route('admin.product.update',['product'=>$product->id]) }}">
                @csrf
                @method('put')
                <div>
                    <div class="mb-3 text-capitalize">
                        <label for="ten_sp" class="form-label">Tên Sản Phẩm</label>
                        <input value="{{ old('ten_sp') ?? $product->ten_sp }}" type="text" class="form-control" id="ten_sp" name="ten_sp"
                            aria-describedby="ten_spHelp" >
                        @error('ten_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="gia_sp" class="form-label">Giá Sản Phẩm</label>
                        <input value="{{ old('gia_sp') ?? $product->gia_sp}}" type="number" class="form-control" id="gia_sp" name="gia_sp"
                            aria-describedby="gia_spHelp" >
                        @error('gia_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="giakm_sp" class="form-label">Giá khuyến mãi Sản Phẩm</label>
                        <input value="{{ old('giakm_sp') ?? $product->giakm_sp}}" type="number" class="form-control" id="giakm_sp" name="giakm_sp"
                            aria-describedby="giakm_spHelp" >
                        @error('giakm_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="soluong_sp" class="form-label">số lượng Sản Phẩm</label>
                        <input value="{{ old('soluong_sp') ?? $product->soluong_sp}}" type="number" class="form-control" id="soluong_sp"
                            name="soluong_sp" aria-describedby="soluong_spHelp" >
                        @error('soluong_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="tinhtrang_sp" class="form-label">tình trạng Sản Phẩm</label>
                        <div class="form-group">
                            <select class="form-select" name="tinhtrang_sp" id="tinhtrang_sp">
                                <option value="1" {{$product->tinhtrang_sp == '1'?'selected':''}}>Hàng Mới</option>
                                <option value="0" {{$product->tinhtrang_sp == '0'?'selected':''}}>Hàng Cũ</option>
                            </select>
                        </div>
                        @error('tinhtrang_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="noibat_sp" class="form-label">Sản Phẩm nổi bật</label>
                        <div class="form-group">
                            <select class="form-select" name="noibat_sp" id="noibat_sp">
                                <option value="0" {{$product->noibat_sp == '0'?'selected':''}}>Không</option>
                                <option value="1" {{$product->noibat_sp == '1'?'selected':''}}>Có</option>
                            </select>
                        </div>
                        @error('noibat_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="phukien_sp" class="form-label">phụ kiện Sản Phẩm</label>
                        <input value="{{ old('phukien_sp') ?? $product->phukien_sp }}" type="text"
                            class="form-control" id="phukien_sp" name="phukien_sp" aria-describedby="phukien_spHelp">
                        @error('phukien_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="khuyemai_sp" class="form-label">Khuyến mãi Sản Phẩm</label>
                        <input value="{{ old('khuyemai_sp') ?? $product->khuyenmai_sp}}" type="text" class="form-control" id="khuyemai_sp"
                            name="khuyemai_sp" aria-describedby="khuyemai_spHelp">
                        @error('khuyemai_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="cat_id" class="form-label">Danh Mục sản phẩm</label>
                        <div class="form-group">
                            <select name="cat_id" id="cat_id" class="form-select" aria-label="Lựa chọn danh mục">
                                <option disabled value="">--Danh mục--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->cat_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->ten_dm }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        @error('cat_id')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <div class="mb-3 text-capitalize">
                        <label for="upload_sp" class="form-label">Ảnh Sản Phẩm</label>
                        <input accept="image/*" value="{{ old('upload_sp')}}" type="file" class="form-control"
                            id="upload_sp" name="upload_sp" aria-describedby="upload_spHelp">
                        <div class="preview-image">
                            <img src="{{ $product->anh_sp ? config('cloudinary.base_url') . $product->anh_sp: config('cloudinary.default_image') }}"
                                alt="Default Image" id="img-preview">
                        </div>
                        @error('upload_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <label for="mota_sp" class="form-label">mô tả Sản Phẩm</label>
                        <textarea class="form-control" id="content" name="mota_sp">
                            {{$product->mota_sp}}
                        </textarea>
                        <script>
                            CKEDITOR.replace('content');
                        </script>
                        @error('mota_sp')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3 text-capitalize">
                        <button type="submit" class="btn btn-primary">
                            Đồng Ý
                        </button>
                        <a href="{{ route('admin.category.index') }}">
                            <div class="btn-group" role="group" aria-label="">
                                <button type="button" class="btn btn-danger">
                                    Hủy
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('ct-js')
    <script>
        $(document).ready(function() {
            const defaultImage =
                "https://res.cloudinary.com/dtbzvmb6r/image/upload/v1713000682/products/preview-phone.png";
            const previewImage = $('#img-preview');
            const fileInput = $('#upload_sp');

            fileInput.on('change', function() {
                const file = this.files[0];

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImage.attr('src', defaultImage);
                }
            });

            previewImage.on('click', function() {
                fileInput.click();
            });
        });
    </script>
@endpush

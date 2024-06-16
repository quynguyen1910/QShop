@extends('admin.shared.layouts.master-layout')
@section('title')
    Product
@endsection
@push('ct-style')
    <style>
        .custom-div {
            width: 120px;
            height: 100px;
            overflow: hidden;
            /* Đảm bảo hình ảnh không bị tràn ra ngoài khung */
            position: relative;
            /* Để các phần tử con có thể được định vị tương đối */
        }

        .custom-div img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Đảm bảo hình ảnh bị cắt đi phù hợp với khung của div */
            position: absolute;
            /* Để hình ảnh điền vào toàn bộ không gian của div */
            top: 0;
            left: 0;
        }
    </style>
@endpush
@section('main')
    <div class="row">
        <div class="my-3 d-flex gap-3 align-items-start">
            <a href="{{ route('admin.product.create') }}">
                <button type="button" class="btn btn-primary">
                    Thêm Sản Phẩm
                </button>
            </a>
        </div>
        <div class="pb-3">
            @include('admin.shared.include.formFilter', ['routeAction' => route('admin.product.index')])
        </div>

        <table id="userTable" class="table table-hover table-responsive">
            <thead class="text-capitalize">
                <th>Tên Sản Phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Thuộc danh mục</th>
                <th>Giá</th>
                <th>Giá khuyến mãi</th>
                <th>Số lượng</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                @foreach ($products as $key => $item)
                    <tr>
                        <td>{{ $item->ten_sp }}</td>
                        <td>
                            <div class="custom-div">
                                <img src="{{ config('cloudinary.base_url') . $item->anh_sp ?? config('cloudinary.default_image') }}" alt="{{ $item->slug }}">
                            </div>
                        </td>
                        <td>{{ $item->category->ten_dm }}</td>
                        <td>{{ $item->gia_sp }}</td>
                        <td>{{ $item->giakm_sp }}</td>
                        <td>{{ $item->soluong_sp }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                @include('admin.shared.include.buttonAction', [
                                    'nameDel' => $item->ten_sp,
                                    'routeDel' => route('admin.product.destroy', ['product' => $item->id]),
                                    'routeEdit' => route('admin.product.edit', ['product' => $item->id]),
                                    'isDel' => $item->deleted_at,
                                    'recycle' => route('admin.product.restore', ['product' => $item->id]),
                                ])
                                <button type="button" class="user-details-button btn btn-primary"
                                    data-user-id="{{ $item->id }}">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="detail-row" style="display: none;">
                        <td colspan="6">
                            <div class="user-details" id="details-{{ $item->id }}">
                                <ul class="text-capitalize d-flex flex-column gap-2">
                                    <li class="row"><span class="col-2">Tình trạng:</span> <span
                                            class="fw-bold col-10">{{ $item->tinhtrang_sp ? 'Hàng Mới' : 'Hàng Cũ' }}</span>
                                    </li>
                                    <li class="row"><span class="col-2">nổi bật:</span><span
                                            class="fw-bold col-10">{{ $item->noibat_sp ? 'Đúng' : 'Không' }}</span></li>
                                    <li class="row"><span class="col-2">Phụ Kiện:</span><span
                                            class="fw-bold col-10">{{ $item->phukien_sp }}</span></li>
                                    <li class="row"><span class="col-2">Khuyến Mãi:</span><span
                                            class="fw-bold col-10">{{ $item->khuyenmai_sp }}</span></li>
                                    <li class="row"><span class="col-2">Mô tả:</span><span
                                            class="fw-bold col-10">{!! $item->mota_sp !!}</span></li>
                                    <li class="row"><span class="col-2">Ngày tạo:</span><span
                                            class="fw-bold col-10">{{ $item->created_at }}</span></li>
                                    <li class="row"><span class="col-2">Ngày cập nhật:</span><span
                                            class="fw-bold col-10">{{ $item->updated_at }}</span></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links('vendor.pagination.custom') }}
    </div>
@endsection
@push('ct-js')
    <script>
        $(document).ready(function() {
            $('.user-details-button').on('click', function() {
                var button = $(this);
                var userId = button.data('user-id');
                var detailRow = button.closest('tr').next('.detail-row');

                // Kiểm tra xem hàng chi tiết có đang hiển thị hay không
                if (detailRow.is(':visible')) {
                    detailRow.hide();
                } else {
                    // Ẩn tất cả các hàng chi tiết trước khi hiển thị hàng chi tiết mới
                    $('.detail-row').hide();

                    // Kiểm tra xem nội dung đã được tải chưa
                    if (detailRow.find('.user-details').is(':empty')) {
                        // Tải nội dung chi tiết từ máy chủ hoặc thêm nội dung tĩnh vào đây
                        var userDetails = `
                        <p><strong>Tên tài khoản:</strong> ${userId}</p>
                        <p><strong>Thông tin thêm:</strong> Thông tin chi tiết cho người dùng ${userId}</p>
                    `;
                        detailRow.find('.user-details').html(userDetails);
                    }

                    detailRow.show();
                }
            });
        });
    </script>
@endpush

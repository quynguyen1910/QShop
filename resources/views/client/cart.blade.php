@extends('client.shared.layouts.master-layout')
@section('title')
    Cart
@endsection
@push('ct-meta')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endpush
@section('main')
            <!-- Cart Page Start -->
            <div style="margin-top: 100px" class="container-fluid py-5">
                <div class="container py-5">
                    <button type="button" class="btn btn-primary text-white updateCart">
                        cập nhật giỏ hàng</button>
                    <button type="button" class="btn btn-danger text-white">
                        Xóa Hết</button>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Hành Động</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product )
                                <tr data-id="{{$product['id']}}" class="product-item-cart">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{config('cloudinary.base_url').$product['anh_sp']}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{$product['ten_sp']}}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">{{\App\Helpers\ParseVND::formatCurrency($product['gia_sp'])}}</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input data-id="{{$product['id']}}" type="text" class="form-control form-control-sm text-center border-0 quantityCart" value="{{$product['soluong_sp']}}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4">Tổng tiền</p>
                                    </td>
                                    <td>
                                        <button data-id='{{$product['id']}}' class="delToCart btn btn-md rounded-circle bg-light border mt-4" >
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Giỏ Hàng</h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Tổng Sản Phẩm</h5>
                                        <p id="totalQuantity" class="mb-0">{{$totalQuantity}}</p>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Tổng Tiền</h5>
                                        <p  id="totalPrice" class="mb-0">{{$totalPrice}}</p>
                                    </div>
                                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Mua Hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart Page End -->
            <form id="updateCartForm" method="POST" action="{{ route('cart.update') }}" hidden>
                @csrf
                @method('put')
                <input type="hidden" name="updateData" id="updateData" value="">
            </form>
@endsection

@push('ct-js')
<script>
  $(document).ready(function() {
    $('.delToCart').click(function(e) {
        e.preventDefault();

        let productId = $(this).data('id');

        $.ajax({
            type: "POST", // Thay type thành POST
            url: "{{ route('cart.delete') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_method': 'DELETE', // Thêm phần này để xác định là DELETE request
                'product_id': productId
            },
            success: function(response) {
                if (response.success) {
                    $('#totalQuantity').text(response.totalQuantity);
                    $('#totalPrice').text(response.totalPrice);
                    $(`.product-item-cart[data-id="${productId}"]`).remove();
                } else {
                    alert('Xóa sản phẩm không thành công: ' + response.message);
                }
            },
            error: function(xhr) {
                console.log('Đã xảy ra lỗi');
            }
        });
    });

    $('.updateCart').click(function (e) {
    e.preventDefault(); // Ngăn chặn hành vi mặc định của nút

    let $quantityItems = $('.quantityCart');
    let $updateData = [];
    $quantityItems.each(function () {
        let $productId = $(this).data('id');
        let $quantity = +$(this).val(); // Chuyển đổi giá trị thành số
        $updateData.push({'productId': $productId, 'quantity': $quantity});
    });

    // Đổ dữ liệu vào input trong form
    $('#updateData').val(JSON.stringify($updateData));

    // Submit form
    $('#updateCartForm').submit();
});

// $.ajax({
//     type: "POST", // Phương thức POST
//     url: "{{ route('cart.update') }}", // Đường dẫn đến route cập nhật giỏ hàng trong Laravel
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Đảm bảo token CSRF
//     },
//     data: {
//         '_method': 'PUT', // Gửi phương thức PUT dưới dạng _method
//         'updateData': $updateData // Dữ liệu cập nhật gồm các sản phẩm và số lượng mới
//     },
//     success: function (response) {
//         // Xử lý khi gọi Ajax thành công (nếu cần)
//         console.log(response); // Log response từ server
//     },
//     error: function (xhr, status, error) {
//         // Xử lý khi gọi Ajax thất bại (nếu cần)
//         console.error(error); // Log lỗi nếu có
//     }
// });






});
</script>
@endpush
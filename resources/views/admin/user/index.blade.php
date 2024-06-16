@extends('admin.shared.layouts.master-layout')
@section('title')
    User
@endsection
@section('main')
    <div class="row">
        <div class="my-3 d-flex gap-3 align-items-start">
            <a href="{{ route('admin.user.create') }}">
                <button type="button" class="btn btn-primary">
                    Thêm Tài Khoản
                </button>
            </a>

        </div>
        <div class="pb-3">
            @include('admin.shared.include.formFilter', ['routeAction' => route('admin.user.index')])
        </div>
        
        <table id="userTable" class="table table-hover table-responsive">
            <thead class="text-capitalize">
                <th>Tên tài khoản</th>
                <th>Email</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!$user->deleted_at)
                                <span class="bg-success rounded p-1 text-center text-uppercase">Hoạt động</span>
                            @else
                                <span class="bg-danger rounded p-1 text-center text-uppercase">Dừng hoạt động</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            @include('admin.shared.include.buttonAction', [
                                'nameDel' => $user->username,
                                'routeDel' => route('admin.user.destroy', ['user' => $user->id]),
                                'routeEdit' => route('admin.user.edit', ['user' => $user->id]),
                                'isDel' => $user->deleted_at,
                                'recycle' => route('admin.user.restore', ['user' => $user->id]),
                            ])
                            <button type="button" class="user-details-button btn btn-primary"
                                data-user-id="{{ $user->id }}">
                                <i class="fa fa-info" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    <tr class="detail-row" style="display: none;">
                        <td colspan="6">
                            <div class="user-details" id="details-{{ $user->id }}">
                                <ul>
                                    <li class="d-flex gap-5"><span style="width: 100px">Họ và Tên:</span> <span
                                            class="fw-bold">{{ $user->ho . ' ' . $user->ten }}</span></li>
                                    <li class="d-flex gap-5"><span style="width: 100px">Địa chỉ:</span><span
                                            class="fw-bold">{{ $user->diachi }}</span></li>
                                    <li class="d-flex gap-5"><span style="width: 100px">Ngày sinh:</span><span
                                            class="fw-bold">{{ $user->ngaysinh }}</span></li>
                                    <li class="d-flex gap-5"><span style="width: 100px">Giới tính:</span><span
                                            class="fw-bold">{{ $user->gioitinh == '0' ? 'Nam' : 'Nữ' }}</span></li>
                                    <li class="d-flex gap-5"><span style="width: 100px">Điện Thoại:</span><span
                                            class="fw-bold">{{ $user->dienthoai }}</span></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        {{ $users->links('vendor.pagination.custom') }}
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

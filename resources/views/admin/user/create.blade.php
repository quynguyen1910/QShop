@extends('admin.shared.layouts.master-layout')
@section('title')
    User-create
@endsection
@section('main')
    <div class="row">
        <div class="m-auto col-6 shadow p-3 mt-3">
            <h1 class="text-uppercase text-center">Tạo Tài khoản mới</h1>
            @if ($errors->any())
                <div class="alert alert-danger text-uppercase text-center">
                    Kiểm tra lại dữ liệu
                </div>
            @endif
            <form class="form-create-user" method="POST" action="{{ route('admin.user.store') }}">
                @csrf

                <div class="mb-3 text-capitalize">
                    <label for="ho" class="form-label">Họ</label>
                    <input value="{{ old('ho') }}" type="text" class="form-control" id="ho" name="ho"
                        aria-describedby="hoHelp" placeholder="Họ...">
                    @error('ho')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="ten" class="form-label">Tên</label>
                    <input value="{{ old('ten') }}" type="text" class="form-control" id="ten" name="ten"
                        aria-describedby="tenHelp" placeholder="Tên...">
                    @error('ten')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-3 text-capitalize">
                    <label for="diachi" class="form-label">Địa chỉ</label>
                    <input value="{{ old('diachi') }}" type="text" class="form-control" id="diachi" name="diachi"
                        aria-describedby="diachiHelp" placeholder="Địa chỉ của bạn...">
                    @error('diachi')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="dienthoai" class="form-label">Số điện thoại</label>
                    <input value="{{ old('dienthoai') }}" type="text" class="form-control" id="dienthoai"
                        name="dienthoai" aria-describedby="dienthoaiHelp" placeholder="Số điện thoại...">
                    @error('dienthoai')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror

                </div>

                <div class="mb-3 text-capitalize">
                    <label for="ngaysinh" class="form-label">Ngày Sinh</label>
                    <input value="{{ old('ngaysinh') }}" type="date" class="form-control" id="ngaysinh" name="ngaysinh"
                        aria-describedby="ngaysinhHelp" placeholder="Địa chỉ của bạn...">
                    @error('ngaysinh')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="gioitinh" class="form-label">giới tính</label>
                    <div class="">
                        <div class="form-check">
                            <input value="0" class="form-check-input" type="radio" name="gioitinh" id="gioitinh1">
                            <label class="form-check-label" for="gioitinh1">
                                Nam
                            </label>
                        </div>
                        <div class="form-check">
                            <input value="1" class="form-check-input" type="radio" name="gioitinh" id="gioitinh2"
                                checked>
                            <label class="form-check-label" for="gioitinh2">
                                Nữ
                            </label>
                        </div>

                        @error('gioitinh')
                            <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}" type="text" class="form-control" id="email" name="email"
                        aria-describedby="emailHelp" placeholder="nhập email...">
                    @error('email')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="username" class="form-label">Tên tài khoản</label>
                    <input value="{{ old('username') }}" type="text" class="form-control" id="username"
                        name="username" aria-describedby="usernameHelp" placeholder="nhập tên tài khoản...">
                    @error('username')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 text-capitalize mt-auto">
                    <button type="submit" class="btn btn-primary">
                    Đồng Ý
                    </button>
                    <a href="{{ route('admin.user.index') }}">
                        <div class="btn-group" role="group" aria-label="">
                            <button type="button" class="btn btn-danger">
                                Hủy
                            </button>
                        </div>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

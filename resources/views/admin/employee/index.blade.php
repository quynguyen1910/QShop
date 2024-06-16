@extends('admin.shared.layouts.master-layout')
@section('title')
Employees
@endsection
@section('main')

<div class="row">
    <div class="my-3 d-flex gap-3 align-items-start">
        <a href="{{route('admin.employee.create')}}">
            <button type="button" class="btn btn-primary">
                Thêm Nhân Viên
                </button>
        </a>
    </div>
    <div class="pb-3">
        @include('admin.shared.include.formFilter',['routeAction' => route('admin.employee.index')])
            </div>
<table class="table table-hover">
    <thead class="text-capitalize">
        <th>Họ Tên</th>
        <th>Ngày Sinh</th>
        <th>Giới Tính</th>
        <th>Địa Chỉ</th>
        <th>Điện Thoại </th>
        <th>Tên Tài khoản</th>
        <th>Trạng thái tài khoản</th>
        <th>hành động</th>
    </thead>
    <tbody>
        @foreach ($employees as $item )
            <tr>
                <td>{{$item->ho. " ".$item->ten}}</td>
                <td>{{$item->ngaysinh}}</td>
                <td>{{$item->gioitinh === '1'? 'Nữ':'Nam'}}</td>
                <td>{{$item->diachi}}</td>
                <td>{{$item->dienthoai}}</td>
                <td>{{$item->user->username}}</td>
                <td>
                    @if (!$item->user->deleted_at)
                        <span class="bg-success rounded p-1 text-center text-uppercase">Hoạt động</span>
                    @else
                    <span class="bg-danger rounded p-1 text-center text-uppercase">Dừng hoạt động</span>
                    @endif
                </td>
                <td>
                    @include('admin.shared.include.buttonAction',['nameDel'=>$item->ho. " ".$item->ten,'routeDel'=>route('admin.employee.destroy',['employee'=>$item->id]),'routeEdit'=>route('admin.employee.update',['employee'=>$item->id])])
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $employees->links('vendor.pagination.custom') }}
</div>
@endsection
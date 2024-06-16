@extends('admin.shared.layouts.master-layout')
@section('title')
    Category
@endsection
@section('main')
    <div class="row">
        <div class="my-3 d-flex gap-3 align-items-start">
            <a href="{{ route('admin.category.create') }}">
                <button type="button" class="btn btn-primary">
                    Thêm Danh Mục
                </button>
            </a>
        </div>
        <div class="pb-3">
            @include('admin.shared.include.formFilter', ['routeAction' => route('admin.category.index')])
        </div>

        

        <table class="table table-hover table-responsive">
            <thead class="text-capitalize">
                <tr>
                    <th>Tên Danh Mục</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhật</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->ten_dm }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            @include('admin.shared.include.buttonAction', [
                                'nameDel' => $category->ten_dm,
                                'routeDel' => route('admin.category.destroy', ['category' => $category->id]),
                                'routeEdit' => route('admin.category.edit', ['category' => $category->id]),
                                'isDel'=>$category->deleted_at,
                                'recycle'=>route('admin.category.restore',['category'=>$category->id])

                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<!-- Hiển thị phân trang -->
{{ $pagination->links('vendor.pagination.custom') }}


    </div>
@endsection

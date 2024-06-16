@extends('admin.shared.layouts.master-layout')
@section('title')
category-edit
@endsection
@section('main')
<div class="row">
    <div class="m-auto col-6 shadow p-3 mt-3">
        <h1 class="text-uppercase text-center">Chỉnh sửa Danh mục</h1>
        @if ($errors->any())
            <div class="alert alert-danger text-uppercase text-center">
                Kiểm tra lại dữ liệu
            </div>
        @endif
        <form class="" method="POST" action="{{ route('admin.category.update',['category'=>$category->id]) }}">
            @csrf
            @method('put')
            <div class="mb-3 text-capitalize">
                <label for="ten_dm" class="form-label">Tên Danh Mục</label>
                <input value="{{ old('ten_dm') ?? $category->ten_dm}}" type="text" class="form-control" id="ten_dm" name="ten_dm"
                    aria-describedby="ten_dmHelp" placeholder="Tên Danh Mục...">
                @error('ten_dm')
                    <span class="text-danger">*{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-capitalize">
                <label for="parent_id" class="form-label">Danh Mục Cha</label>
                <select name="parent_id" id="parent_id" class="form-select" aria-label="Default select example">
                    <option value="">Danh mục Cha</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @if ($cat->id == $category->parent_id) selected @endif>{{ $cat->ten_dm }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span class="text-danger">*{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-3 text-capitalize mt-auto">
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
        </form>
    </div>
</div>
@endsection
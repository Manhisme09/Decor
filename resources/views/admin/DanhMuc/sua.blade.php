@extends('admin.layouts.layout')
@section('head')
    <title>Cập nhật danh mục sản phẩm</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa thông tin danh mục</h1>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            {{ 'Bạn vui lòng nhập đầy đủ các thông tin theo yêu cầu !' }}
        </div>
    @endif
    @if (session('thongbao'))
        <div class="alert alert-success">
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Sửa thông tin danh mục
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.DanhMuc.postSua', ['id' => $danhmuc->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="danh_muc">Tên danh mục<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" name="ten_danh_muc" value="{{ $danhmuc->ten_danh_muc }}"
                        autocomplete="off" />
                    @error('ten_danh_muc')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group" style="width: 40%;">
                    <label for="parent_id">Danh mục<span style="color: red"> *</span></label>
                    <select class="form-control" name="parent_id">
                        <option value="0">Danh mục cha</option>
                        @if (isset($parents))
                            @foreach ($parents as $parent)
                                <option @if ($parent->id === $danhmuc->parent_id) selected @endif value="{{ $parent->id }}">
                                    {{ $parent->ten_danh_muc }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('parent_id')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <a type="button" href="{{ route('admin.DanhMuc.index') }}" class="btn btn-success" value="quay lại">Quay
                    lại</a>
                <button type="submit" class="btn btn-primary mb-2">Lưu</button>
            </form>
        </div>
    </div>

@endsection

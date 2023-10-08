@extends('admin.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm bài viết</h1>
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
            Thêm bài viết
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.baiviet.postThem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tieu_de">Tiêu đề<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" id="tieu_de" placeholder="Tiêu đề bài viết" name="tieu_de"
                        value="{{ old('tieu_de') }}" autocomplete="off" />
                    @error('tieu_de')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <label for="hinh_anh">Hình ảnh<span style="color: red"> *</span></label>
                            <input type="file" class="custom-file-input" id="hinh_anh" name="hinh_anh"
                                value="{{ old('hinh_anh') }}">
                        </div>
                        <span>Xem trước: </span>
                        <div class="preview-images">
                        @error('hinh_anh')
                            <p style="color: red">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="ghi_chu">Nội dung<span style="color: red"> *</span></label>
                    <textarea class="form-control ckeditor" id="demo" name="noi_dung" rows="5">{{ old('noi_dung') }}</textarea>
                    @error('noi_dung')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="trang_thai">Xếp loại</label>
                    <select class="form-control" name="trang_thai">
                        <option value="0" selected>Bình thường</option>
                        <option value="1">Nổi bật</option>
                    </select>
                </div>
                <a type="button" href="{{ route('admin.baiviet.index') }}" class="btn btn-success" value="quay lại">Quay
                    lại</a>
                <button type="submit" class="btn btn-primary mb-2">Lưu</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files.length > 0) {
                $('.preview-images').empty();
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgElement = $('<img width="250px" height="150px">').attr('src', e.target.result).addClass('preview-image');
                        $('.preview-images').append(imgElement);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

$("#hinh_anh").change(function() {
    readURL(this);
});
    </script>
@endsection

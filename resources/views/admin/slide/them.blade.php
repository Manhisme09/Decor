@extends('admin.layouts.layout')
@section('head')
    <title>Thêm slide</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm slide</h1>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Thêm slide mới</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="{{ route('admin.slide.postThem') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên slide</label>
                                    <input class="form-control" name="ten_slide" placeholder="Nhập tên slide...">
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <label for="hinh_anh">Hình ảnh <span style="color: red"> *</span></label>
                                            <input type="file" class="custom-file-input" id="hinh_anh" name="hinh_anh">
                                        </div>
                                        <span>Xem trước: </span>
                                        <img id="blah" width="350px" height="150px" src="">
                                    </div>
                                    @error('hinh_anh')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                        </div>
                        <a type="button" href="{{ route('admin.slide.index') }}" class="btn btn-success"
                            value="quay lại">Quay lại</a>
                        <input type="submit" class="btn btn-primary mb-2" value="Lưu">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#hinh_anh").change(function() {
            readURL(this);
        });
    </script>
@endsection

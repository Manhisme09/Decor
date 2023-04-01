@extends('admin.layouts.layout')
@section('head')
    <title>Thêm sản phẩm</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
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
                <div class="panel-heading">
                    Nhập sản phẩm mới
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" action="{{ route('admin.SanPham.postThem') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="them">
                                    <div class="form-group">
                                        <label for="danh_muc_id">Danh mục <span style="color: red"> *</span></label>
                                        <select class="form-control" style="width: 30%" name="danh_muc_id"
                                            id="danh_muc_id">
                                            <option value="" disabled selected>--- Danh mục ---</option>
                                            @if (isset($danhMuc))
                                                @foreach ($danhMuc as $danhmuc)
                                                    <option value="{{ $danhmuc->id }}">{{ $danhmuc->ten_danh_muc }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('danh_muc_id')
                                            <p style="color: red"> {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="ten_san_pham">Tên sản phẩm <span style="color: red"> *</span></label>
                                        <input class="form-control" id="ten_san_pham" name="ten_san_pham"
                                            placeholder="Nhập tên sản phẩm..." value="{{ old('ten_san_pham') }}">
                                        @error('ten_san_pham')
                                            <p style="color: red"> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="so_luong">Số lượng <span style="color: red"> *</span></label>
                                        <input type="number" min="0" style="width: 30%" class="form-control" id="so_luong"
                                            name="so_luong" placeholder="Nhập số lượng sản phẩm"
                                            value="{{ old('so_luong') }}">
                                        @error('so_luong')
                                            <p style="color: red"> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gia_ban">Đơn giá bán (VNĐ) <span style="color: red"> *</span></label>
                                        <input type="number" min="0" style="width: 30%" class="form-control" id="gia_ban"
                                            name="gia_ban" placeholder="Nhập giá sản phẩm" value="{{ old('gia_ban') }}">
                                        @error('gia_ban')
                                            <p style="color: red"> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <label for="hinh_anh">Hình ảnh sản phẩm <span style="color: red">*</span></label>
                                                <input type="file" class="custom-file-input" id="hinh_anh" name="hinh_anh">
                                            </div>
                                            <span>Xem trước: </span>
                                            <img id="blah" width="250px" height="150px" src="">
                                        </div>
                                        @error('hinh_anh')
                                            <p style="color: red"> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="thuoc_tinh">Thuộc tính</label>
                                        <textarea class="form-control ckeditor" id="demo" name="thuoc_tinh" placeholder=""
                                            rows="5">{{ old('thuoc_tinh') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="mo_ta">Mô tả</label>
                                        <textarea class="form-control ckeditor" id="demo" name="mo_ta" placeholder="" rows="5">{{ old('mo_ta') }}</textarea>
                                    </div>
                                </div>
                                <a type="button" href="{{ route('admin.SanPham.index') }}" class="btn btn-success"
                                    value="quay lại">Quay lại</a>
                                <input type="submit" class="btn btn-primary mb-2" value="Lưu">
                            </form>
                        </div>
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

@extends('admin.layouts.layout')
@section('head')
    <title>Thêm thông tin nhân viên</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm nhân viên</h1>
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
            Thêm nhân viên
        </div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ho_ten">Họ tên<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" id="ho_ten" placeholder="Họ và tên" name="ho_ten"
                        value="{{ old('ho_ten') }}" autocomplete="off" />
                    @error('ho_ten')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email<span style="color: red"> *</span></label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                        value="{{ old('email') }}" autocomplete="off" />
                    @error('email')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dien_thoai">Điện thoại<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" id="dien_thoai" placeholder="Số điện thoại" name="dien_thoai"
                        value="{{ old('dien_thoai') }}" autocomplete="off" />
                    @error('dien_thoai')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="width: 40%;">
                    <label for="ngay_sinh">Ngày sinh<span style="color: red"> *</span></label>
                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                        value="{{ old('ngay_sinh') }}" autocomplete="off" />
                    @error('ngay_sinh')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group" style="width: 40%;">
                    <label for="gioi_tinh">Giới tính<span style="color: red"> *</span></label>
                    <select class="form-control" name="gioi_tinh" id="gioi_tinh">
                        <option value="" selected>Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                    @error('gioi_tinh')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dia_chi">Địa chỉ<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="{{ old('dia_chi') }}"
                        placeholder="Địa chỉ" />
                    @error('dia_chi')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Mật khẩu<span style="color: red"> *</span></label>
                    <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password"
                        value="" autocomplete="off" />
                    @error('password')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Xác nhận mật khẩu<span style="color: red"> *</span></label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Xác nhận mật khẩu"
                        name="passwordAgain" value="">
                    @error('passwordAgain')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <a type="button" href="{{ route('admin.nhanvien.index') }}" class="btn btn-success" value="quay lại">Quay
                    lại</a>
                <button type="submit" class="btn btn-primary mb-2">Lưu</button>
            </form>
        </div>
    </div>
@endsection

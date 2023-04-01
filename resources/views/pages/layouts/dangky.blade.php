@extends('pages.layouts.layout')
@section('title')
    <title>Đăng ký thành viên | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.dangky') }}">Đăng ký</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="regis-title">
                    <h3>ĐĂNG KÝ</h3>
                </div>
                <div class="regis-content">
                    <form action="{{ route('pages.postdangky') }}" method="post" class="beta-form-checkout">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <h3>Đăng ký</h3>
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
                                <div class="space20">&nbsp;</div>

                                <div class="form-block">
                                    <label for="email">Email <span style="color: red">*</span></label>
                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-block">
                                    <label for="ho_ten">Họ tên <span style="color: red">*</span></label>
                                    <input class="form-control" type="text" id="ho_ten" name="ho_ten"
                                        placeholder="Họ và tên" value="{{ old('ho_ten') }}">
                                    @error('ho_ten')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-block">
                                    <label for="ngay_sinh">Ngày sinh <span style="color: red">*</span></label>
                                    <input class="form-control" type="date" id="ngay_sinh" name="ngay_sinh"
                                        placeholder="Ngày sinh" value="{{ old('ngay_sinh') }}">
                                    @error('ngay_sinh')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-block">
                                    <label for="dia_chi">Địa chỉ <span style="color: red">*</span></label>
                                    <input class="form-control" type="text" id="dia_chi" name="dia_chi"
                                        placeholder="Địa chỉ" value="{{ old('dia_chi') }}">
                                    @error('dia_chi')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-block">
                                    <label for="dien_thoai">Số điện thoại <span style="color: red">*</span></label>
                                    <input class="form-control" type="text" id="dien_thoai" name="dien_thoai"
                                        placeholder="Số điện thoại" value="{{ old('dien_thoai') }}">
                                    @error('dien_thoai')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="password">Mật khẩu <span style="color: red">*</span></label>
                                    <input class="form-control" type="password" id="password" name="password"
                                        placeholder="Mật khẩu">
                                    @error('password')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-block">
                                    <label for="exampleFormControlInput1">Xác nhận mật khẩu<span style="color: red">
                                            *</span></label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        placeholder="Xác nhận mật khẩu" name="passwordAgain" value="">
                                    @error('passwordAgain')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                    <small class="form-text text-muted ml-3 pull-right">Các trường có dấu (<span
                                            style="color: red">*</span>) không được để trống!</small>
                                </div>
                                <div class="form-block">
                                    <button type="submit" class="btn btn-primary pull-right">Đăng ký</button>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- .container -->
@endsection

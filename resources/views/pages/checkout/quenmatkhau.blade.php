@extends('pages.layouts.layout')
@section('title')
    <title>Hỗ trợ đặt lại mật khẩu | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.quenmatkhau') }}">Quên mật khẩu</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="profile-title">
                    <h3>QUÊN MẬT KHẨU</h3>
                </div>
                <div class="profile-content">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2 style="text-align: center">Đặt lại mật khẩu</h2>
                                @if (Session('err'))
                                    <div class="alert alert-danger">
                                        {{ Session('err') }}
                                    </div>
                                @endif
                                @if (Session('message'))
                                    <div class="alert alert-success">
                                        {{ Session('message') }}
                                    </div>
                                @endif

                                <form action="{{ route('pages.sendMail') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <p class="align" style="color: red; margin-top: 25px;">Bạn quên mật khẩu
                                            đăng nhập?</p>
                                        <p class="align" style="color: red">Nhập email đăng ký tài khoản ở đây,
                                            chúng tôi sẽ giúp bạn lấy lại mật khẩu</p>
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" name="email" placeholder="Nhập email ..."
                                            required>
                                    </div>
                                    <button style="width:100%; margin-bottom:20px" type="submit"
                                        class="btn btn-primary">Gửi</button>
                                    <p class="align"><a href="{{ route('pages.dangky') }}">Tạo tài khoản mới</a>
                                    </p>
                                    <p class="align">Đã có tài khoản? <a
                                            href="{{ route('pages.dangnhap') }}">Đăng nhập</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space90">&nbsp;</div>
@endsection

@extends('pages.layouts.layout')
@section('title')
    <title>Đăng nhập tài khoản | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.dangnhap') }}">Đăng nhập</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="login-title">
                    <h3>ĐĂNG NHẬP</h3>
                </div>
                <div class="login-content">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Xin mời bạn đăng nhập vào hệ thống !</h3>
                                </div>
                                <div class="panel-body">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (session('thongbao'))
                                        <div class="alert alert-success">
                                            {{ session('thongbao') }}
                                        </div>
                                    @endif
                                    @if (session('loi'))
                                        <div class="alert alert-danger">
                                            {{ session('loi') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('pages.postdangnhap') }}" method="POST" role="form">
                                        @csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Email" name="email" type="email"
                                                    autofocus required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Mật khẩu" name="password"
                                                    type="password" required>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input name="remember" type="checkbox">Ghi nhớ đăng nhập
                                                </label>
                                                <a style="margin-left: 60px" href="{{ route('pages.quenmatkhau') }}">Quên
                                                    mật khẩu?</a>
                                            </div>

                                            <!-- Change this to a button or input when using this as a form -->
                                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Đăng nhập">
                                            <a href="{{ route('pages.dangnhapgg') }}"
                                                class="btn-lg btn-primary btn-block hover"> Đăng nhập bằng google</a>
                                            <hr>
                                            <a href="{{ route('pages.dangky') }}"
                                                class="btn-lg btn-success btn-block hover">Tạo tài khoản mới</a>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- #content -->
        <div class="space90">&nbsp;</div>
    </div> <!-- .container -->

@endsection

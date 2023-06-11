@extends('pages.layouts.layout')
@section('title')
    <title>Đăng nhập tài khoản | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="login-title">
                </div>
                <div class="login-content">
                    <div class="row">
                        <div class="form-login">
                            <div class="login-panel panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title" style="line-height: 35px">Xin mời bạn đăng nhập vào hệ thống !</h3>
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
                                                <div>
                                                    <input name="remember" type="checkbox">Ghi nhớ đăng nhập
                                                </div>
                                                <div>
                                                    <a style="margin-left: 60px" href="{{ route('pages.quenmatkhau') }}">Quên
                                                        mật khẩu?</a>
                                                </div>
                                            </div>

                                            <!-- Change this to a button or input when using this as a form -->
                                            <input type="submit" class="btn btn-lg btn-block btn-my" value="Đăng nhập">
                                            {{-- <a href="{{ route('pages.dangnhapgg') }}"
                                                class="btn-lg btn-primary btn-block hover btn-my"> Đăng nhập bằng google</a> --}}

                                            <div class="login-google">
                                                 <a href="{{ route('pages.dangnhapgg') }}" class="btn-google col-sm-12">
                                                    <img class="google-sign" src="https://rs.haposoft.com/images/google.png" alt="Google sign-in">
                                                    Đăng nhập bằng google
                                                </a>
                                            </div>
                                            <a href="{{ route('pages.dangky') }}"
                                                class="btn-lg btn-success btn-block hover btn-my">Tạo tài khoản mới</a>
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

@extends('pages.layouts.layout')
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="profile-title">
                    <h3>THAY ĐỔI MẬT KHẨU</h3>
                </div>
                <div class="profile-content">
                    @if (session('loi'))
                        <div class="alert alert-danger">
                            <button class="close" type="button" data-dismiss="alert" aria-label="close"
                                aria-hidden="true">&times;</button>
                            {{ session('loi') }}
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            <button class="close" type="button" data-dismiss="alert" aria-label="close"
                                aria-hidden="true">&times;</button>
                            {{ session('thongbao') }}
                        </div>
                    @endif
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-change-password" action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="oldPassword">Mật khẩu cũ <span style="color: red">*</span></label>
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                                    @error('oldPassword')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu mới <span style="color: red">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="passwordAgain">Xác nhận mật khẩu mới <span
                                            style="color: red">*</span></label>
                                    <input type="password" class="form-control" id="passwordAgain"
                                        name="passwordAgain">
                                    @error('passwordAgain')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn-my">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space90">&nbsp;</div>
@endsection

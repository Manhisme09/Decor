@extends('pages.layouts.layout')
@section('content')
    {{-- <div class="inner-header">
    <a href="{{ route('trangchu') }}"><i class="fa fa-home"></i> Home</a> /
    <a href="{{ route('pages.getMatkhauUser') }}">Đổi mật khẩu</a>
    <div class="clearfix"></div>
</div> --}}
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.getmatkhau') }}">Đổi mật khẩu</a></span>
        </div>
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
                            <form action="" method="POST">
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
                                    <label for="confirmPassword">Xác nhận mật khẩu mới <span
                                            style="color: red">*</span></label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        name="confirmPassword">
                                    @error('confirmPassword')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space90">&nbsp;</div>
@endsection

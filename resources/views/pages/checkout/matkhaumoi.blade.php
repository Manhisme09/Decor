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
                        <div class=" panel-default">
                            <div class="panel-body">
                                <h2 style="text-align: center">Nhập mật khẩu mới</h2>
                                @if (Session('success'))
                                    <div class="alert alert-success">
                                        {{ Session('success') }}
                                    </div>
                                @endif
                                @if (Session('error'))
                                    <div class="alert alert-danger">
                                        {{ Session('error') }}
                                    </div>
                                @endif
                                @php
                                    $token = $_GET['token'];
                                    $email = $_GET['email'];
                                @endphp
                                <form action="{{ route('pages.postUpdatePass') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <label for="pass">Mật khẩu mới <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="password">
                                        @error('password')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
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

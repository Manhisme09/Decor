@extends('admin.layouts.layout')
@section('head')
    <title>Đổi mật khẩu</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Đổi mật khẩu</h1>
        </div>
    </div>
    @if (session('thongbao'))
        <div class="alert alert-danger">
            {{ session('thongbao') }}
        </div>
    @endif
    @if (session('thanhcong'))
        <div class="alert alert-success">
            {{ session('thanhcong') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Đặt lại mật khẩu
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.postadminpassword') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="oldPassword">Mật khẩu cũ <span style="color: red"> *</span></label>
                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                    @error('oldPassword')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu mới <span style="color: red"> *</span></label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Xác nhận mật khẩu mới <span style="color: red"> *</span></label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    @error('confirmPassword')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
@endsection

@extends('pages.layouts.layout')
@section('title')
    <title>Chăm sóc khách hàng | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.getcskh') }}">Chăm sóc khách hàng</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="contact-title">
                    <h3>CHĂM SÓC KHÁCH HÀNG</h3>
                </div>
                <div class="contact-content">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8" style="border: 1px solid rgb(245, 242, 242)">
                        <h4 style="text-align: center">ĐỂ LẠI LỜI NHẮN</h4>
                        <div class="space20">&nbsp;</div>
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
                        <form action="{{ route('pages.postcskh') }}" method="post" class="contact-form">
                            @csrf
                            <div class="form-block">
                                <input class="form-control" name="ho_ten" type="text" placeholder="Họ tên" required>
                            </div>
                            <div class="form-block">
                                <input class="form-control" name="email" type="email" placeholder="Email" required>
                            </div>
                            <div class="form-block">
                                <input class="form-control" name="dien_thoai" type="text" placeholder="Số điện thoại"
                                    required>
                            </div>
                            <div class="form-block">
                                <textarea class="form-control" rows="10" name="noi_dung" placeholder="Nội dung" required></textarea>
                            </div>
                            <div class="form-block">
                                <button type="submit" class="beta-btn primary pull-right">Gửi ngay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

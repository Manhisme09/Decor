@extends('pages.layouts.layout')
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.getthongtin') }}">Thông tin cá nhân</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="profile-title">
                    <h3>THÔNG TIN TÀI KHOẢN</h3>
                </div>
                <div class="profile-content">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button class="close" type="button" data-dismiss="alert" aria-label="close"
                                aria-hidden="true">&times;</button>
                            @foreach ($errors->all() as $err)
                                {{ $err }}
                            @endforeach
                        </div>
                    @endif
                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            <button class="close" type="button" data-dismiss="alert" aria-label="close"
                                aria-hidden="true"></button>
                            {{ session('thongbao') }}
                        </div>
                    @endif

                    @if (Session('login'))
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ho_ten">Họ tên <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="ho_ten" placeholder="Họ và tên"
                                            name="ho_ten" value="{{ Session('user_login') }}" autocomplete="off"
                                            disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            name="email" value="{{ Session('email') }}" autocomplete="off" disabled />
                                    </div>

                                    <div class="form-group">
                                        <label for="dien_thoai">Điện thoại <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dien_thoai"
                                            placeholder="Số điện thoại" name="dien_thoai" value="{{ Session('phone') }}"
                                            autocomplete="off" disabled />
                                    </div>

                                    <div class="form-group" style="width: 50%;">
                                        <label for="ngay_sinh">Ngày sinh <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                            value="{{ Session('date') }}" autocomplete="off" disabled />
                                    </div>

                                    <div class="form-group">
                                        <label for="dia_chi">Địa chỉ <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                                            value="{{ Session('address') }}" placeholder="Địa chỉ" disabled />
                                    </div>

                                </form>
                            </div>
                        </div>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="{{ route('pages.postthongtin') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ho_ten">Họ tên <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="ho_ten" placeholder="Họ và tên"
                                            name="ho_ten" value="{{ Auth::user()->khach_hang->ho_ten }}"
                                            autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            name="email" value="{{ Auth::user()->email }}" autocomplete="off" disabled />
                                    </div>

                                    <div class="form-group">
                                        <label for="dien_thoai">Điện thoại <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dien_thoai"
                                            placeholder="Số điện thoại" name="dien_thoai"
                                            value="{{ Auth::user()->khach_hang->dien_thoai }}" autocomplete="off"
                                            required />
                                    </div>

                                    <div class="form-group" style="width: 50%;">
                                        <label for="ngay_sinh">Ngày sinh <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                            value="{{ Auth::user()->khach_hang->ngay_sinh }}" autocomplete="off"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label for="dia_chi">Địa chỉ <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                                            value="{{ Auth::user()->khach_hang->ngay_sinh }}" placeholder="Địa chỉ"
                                            required />
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Lưu</button>
                                    <button type="reset" class="btn btn-primary pull-right" style="margin-right: 10px">Nhập
                                        lại</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="space90">&nbsp;</div>

@endsection

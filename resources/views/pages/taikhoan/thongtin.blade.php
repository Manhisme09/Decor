@extends('pages.layouts.layout')
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="profile-title">
                    <h3>THÔNG TIN TÀI KHOẢN</h3>
                </div>
                <div class="profile-content">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {{ 'Bạn vui lòng nhập đầy đủ các thông tin theo yêu cầu !' }}
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
                                            autocomplete="off" />
                                        @error('ho_ten')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
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
                                            />
                                        @error('dien_thoai')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="width: 50%;">
                                        <label for="ngay_sinh">Ngày sinh <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                            value="{{ Auth::user()->khach_hang->ngay_sinh }}" autocomplete="off"
                                            />
                                        @error('ngay_sinh')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="dia_chi">Địa chỉ <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dia_chi" name="dia_chi"
                                            value="{{ Auth::user()->khach_hang->dia_chi }}" placeholder="Địa chỉ"
                                            />
                                        @error('dia_chi')
                                            <p style="color: red">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button style="width: 80px" type="submit" class="btn-my pull-right">Lưu</button>
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

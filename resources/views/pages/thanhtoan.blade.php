@extends('pages.layouts.layout')
@section('title')
    <title>Thanh toán đơn hàng | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.giohang') }}">Giỏ hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="payment-title">
                    <h3>THANH TOÁN</h3>
                </div>
                    <div class="payment-content">
                        <form action="{{ route('pages.postthanhtoan') }}" method="post" class="beta-form-checkout">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3>Thông tin thanh toán</h3>
                                    <div class="space20">&nbsp;</div>

                                    <div class="form-block">
                                        <label for="ho_ten">Họ tên <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                                            placeholder="Nhập họ tên" value="{{ Auth::user()->khach_hang->ho_ten }}">
                                            @error('ho_ten')
                                            <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>

                                    <div class="form-block">
                                        <label for="ngay_sinh">Ngày sinh <span style="color: red">*</span></label>
                                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh"
                                            placeholder="Nhập ngày sinh"
                                            value="{{ Auth::user()->khach_hang->ngay_sinh }}">
                                            @error('ngay_sinh')
                                            <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>

                                    <div class="form-block">
                                        <label for="dien_thoai">Số điện thoại <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="dien_thoai" name="dien_thoai"
                                            placeholder="Nhập số điện thoại"
                                            value="{{ Auth::user()->khach_hang->dien_thoai }}">
                                            @error('dien_thoai')
                                            <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>

                                    <div class="form-block">
                                        <label for="email">Email <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ Auth::user()->email }}" placeholder="Nhập email" disabled>
                                    </div>

                                    <div class="form-block">
                                        <label for="dia_chi">Địa chỉ <span style="color: red">*</span></label>
                                        <textarea id="dia_chi" rows="5" class="form-control" name="dia_chi"
                                            placeholder="Nhập địa chỉ">{{ Auth::user()->khach_hang->dia_chi }}</textarea>
                                            @error('dia_chi')
                                            <p style="color: red">{{ $message }}</p>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6" style="width:49%">
                                    <div class="your-order">
                                        <div class="your-order-head">
                                            <h3>Đơn hàng của bạn</h3>
                                        </div>
                                        <div class="your-order-body">
                                            @if (Session::has('Cart') != null)
                                                @foreach (Session::get('Cart')->sanpham as $item)
                                                    <div class="your-order-item">
                                                        <div>
                                                            <!--  one item	 -->
                                                            <div class="media">
                                                                <img style="width: 100px; height:100px"
                                                                    src="{{ asset($item['sanphamInfo']->image[0]->url) }}"
                                                                    alt="" class="pull-left">
                                                                <div class="media-body">
                                                                    <p class="font-large">
                                                                        {{ $item['sanphamInfo']->ten_san_pham }}</p>
                                                                    <div class="infor_checkout">
                                                                        <p class="color-gray your-order-info">x
                                                                            {{ $item['so_luong'] }}</p>

                                                                        <p class="color-gray your-order-info">Giá:
                                                                                {{ number_format($item['sanphamInfo']->gia_ban) }} VNĐ</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end one item -->
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="your-order-item">
                                                <div class="pull-left">
                                                    <h4 style="font-weight:bold; font-size: 25px" class="your-order-f18">Tổng số tiền:</h4>
                                                </div>
                                                <div class="pull-right">
                                                    <h4 style="font-weight:bold" class="color-black">
                                                        {{ number_format(Session::get('Cart')->tonggia) }} VNĐ</h4>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="your-order-item">
                                                <i>(*) Lưu ý: Thông tin cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng,
                                                    tăng
                                                    trải nghiệm website.</i>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div>
                                                <input type="radio" id="html" name="checkout" value="delivery">
                                                <label style="margin-right: 30px" for="html">Thanh toán khi nhận hàng</label>
                                                <input type="radio" id="css" name="checkout" value="vnpay">
                                                <label for="css">Thanh toán bằng VNPAY</label>
                                            </div>
                                        </div>

                                        <div class="text-center"><button type="submit" name="redirect" class="beta-btn primary">Thanh
                                                toán</button></div>
                                    </div> <!-- .your-order -->
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div> <!-- .container -->
@endsection

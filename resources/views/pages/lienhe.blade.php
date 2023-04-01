@extends('pages.layouts.layout')
@section('title')
    <title>Thông tin liên hệ | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.lienhe') }}">Liên hệ</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="contact-title">
                    <h3>LIÊN HỆ</h3>
                </div>
                <div class="contact-content">
                    <div class="col-sm-6">
                        <h5>CỬA HÀNG NỘI THẤT 1</h5>
                        <p>Địa chỉ: Số 205 Nguyễn Xiển, Hà Nội</p>
                        <p>(mặt đường vành đai 3)</p>
                        <p>Hotline+Zalo : 0931.266.466</p>
                        <a
                            href="https://www.google.com/maps/place/205+%C4%90%C6%B0%E1%BB%9Dng+Nguy%E1%BB%85n+Xi%E1%BB%83n,+T%C3%A2n+Tri%E1%BB%81u,+Thanh+Xu%C3%A2n,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@20.9855821,105.8058413,17z/data=!3m1!4b1!4m5!3m4!1s0x3135aceaf8eef493:0x95aa47aeb8e81440!8m2!3d20.9855771!4d105.80803?hl=vi-VN">Xem
                            bản đồ chỉ đường</a>
                    </div>
                    <div class="col-sm-6">
                        <h5>CỬA HÀNG NỘI THẤT 2</h5>
                        <p>Địa chỉ: Số 27 Đàm Quang Trung, Long Biên, Hà Nội</p>
                        <p>(Chân cầu Vĩnh Tuy, phía Long Biên)</p>
                        <p>Hotline+Zalo : 094.121.2323</p>
                        <a
                            href="https://www.google.com/maps/place/27+%C4%90%C3%A0m+Quang+Trung,+Long+Bi%C3%AAn,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@21.0266017,105.8940916,17z/data=!3m1!4b1!4m5!3m4!1s0x3135a96a7c25a4a3:0xfe68ec5c18fdf86a!8m2!3d21.0265967!4d105.8962803?hl=vi-VN">Xem
                            bản đồ chỉ đường</a>
                    </div>
                    <div class="space100">&nbsp;</div>
                    <div class="col-sm-12">
                        <h5>SHOWROOM TRANH TREO TƯỜNG</h5>
                        <p>Địa chỉ: Số 211 Vũ Tông Phan, Thanh Xuân, Hà Nội</p>
                        <p>(mặt bờ sông)</p>
                        <p>Hotline + Zalo: 0916.225.866</p>
                        <a
                            href="https://www.google.com/maps/place/211+V%C5%A9+T%C3%B4ng+Phan,+Kh%C6%B0%C6%A1ng+Trung,+Thanh+Xu%C3%A2n,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@20.9956233,105.8133544,17z/data=!3m1!4b1!4m5!3m4!1s0x3135ac91b7427ba7:0x4b2f613680e5ac64!8m2!3d20.9956183!4d105.8155431?hl=vi-VN">Xem
                            bản đồ chỉ đường</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

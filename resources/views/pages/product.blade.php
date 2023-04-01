@extends('pages/layouts/layout')
@section('title')
    <title>Danh sách sản phẩm | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.product', ['id' => $danhMuc->id]) }}">{{ $danhMuc->ten_danh_muc }}</a></span>
        </div>
        <div class="sidebar-main">
            <div class="sidebar-content">
                <section id="title-menu">
                    <h2 class="widget-title">Danh mục sản phẩm</h2>
                    <ul id="menu-items">
                        @foreach ($listDanhmuc as $list)
                            <li class="item-menu-product">
                                <a href="{{ route('pages.product', ['id' => $list->id, 'slug' => $list->slug]) }}">{{ $list->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section id="contact-menu">
                    <h2 class="widget-title">Hỗ trợ trực tuyến</h2>
                    <img src="{{ asset('images/support.gif') }}" alt="">
                    <ul id="menu-items">
                        <li class="item-menu-product"> <i class="fas fa-phone-square"></i> + 0963.733.733 </li>
                        <li class="item-menu-product"> <i class="fas fa-envelope"></i> noithatfurnibuy@gmail.com </li>
                    </ul>
                </section>
            </div>
            <div class="main-content">
                <div class="product-container">
                    <div class="grid wide">
                        <div class="product-title" style="margin: 0">
                            <h3>{{ $danhMuc->ten_danh_muc }}</h3>
                        </div>

                        @if (!empty($sanPham[0]))
                            <div class="product-content" style="border: none">
                                <div class="row">
                                    <div class="col l-12 m-10 c-12">
                                        <div id="product1" class="product-content_about product-propose_new active">
                                            <div class="row">
                                                @foreach ($sanPham as $sanpham)
                                                    {{-- <div class="col l-4 m-4 c-6">
                                                <div class="product-propose_new-item">
                                                    <img src="{{ asset($sanpham->hinh_anh) }}" alt="FURNIBUY" class="product-propose_new-item_img">

                                                    <p class="product-propose_new-item_info"> {{ $sanpham->ten_san_pham }}</p>
                                                    <h4 class="product-propose_new-item_price">Giá: {{ number_format($sanpham->gia_ban) }} VNĐ</h4>
                                                </div>
                                            </div> --}}
                                                    <div class="col-md-4" style="margin: 30px 0px">
                                                        <div class="thumbnail">
                                                            <a
                                                                href="{{ route('pages.chitietsanpham', ['id' => $sanpham->id, 'slug' => $sanpham->slug]) }}">
                                                                <img class="product-propose_new-item_img"
                                                                    src="{{ asset($sanpham->hinh_anh) }}" alt="Lights"
                                                                    style="width:100%">
                                                                <div class="caption">
                                                                    <p class="product-propose_new-item_info">
                                                                        {{ $sanpham->ten_san_pham }}</p>
                                                                    <h4 class="product-propose_new-item_price">Giá:
                                                                        {{ number_format($sanpham->gia_ban) }} VNĐ</h4>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <h3>Không có sản phẩm nào</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="product-propose">
            <div class="grid wide">
                <div class="product-propose_title">
                    <h3 class="product-propose_title-name active">SẢN PHẨM BÁN CHẠY</h3>
                    <div class="line"></div>
                </div>
                <div class="product-propose_new active">
                    <div class="product-propose_btn product-propose_prev"><i class="fas fa-angle-left"></i></div>
                    <div class="product-propose_btn product-propose_next"><i class="fas fa-angle-right"></i></div>
                    <div class="row row-nowrap">
                        @foreach ($topSanpham as $item)
                            <div class="col l-3 m-4 c-6 prpduct-propose_list">
                                <div class="product-propose_new-item">
                                    <img class="product-propose_new-item_img" src="{{ asset($item->hinh_anh) }}"
                                        alt="FURNIBUY">
                                    {{-- <img src="https://tokyolife.vn/media/wysiwyg/home/I-Online.svg" alt="" class="product-propose_new-item_logo"> --}}
                                    <p class="product-propose_new-item_info">{{ $item->ten_san_pham }}</p>
                                    <h4 class="product-propose_new-item_price">Giá: {{ number_format($item->gia_ban) }}
                                        VNĐ</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

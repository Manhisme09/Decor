@extends('pages/layouts/layout')
@section('title')
    <title>Danh sách sản phẩm | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="sidebar-main">
            <div class="sidebar-content">
                <section id="title-menu">
                    <h2 class="widget-title">Danh mục sản phẩm</h2>
                    <ul id="menu-items">
                        @foreach ($menu as $list)
                            <li class="item-menu-product">
                                <a
                                    href="{{ route('pages.product', ['id' => $list->id]) }}">{{ $list->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
            <div class="main-content">
                <div class="product-container">
                    <div class="grid wide">
                        <div class="product-title" style="margin: 0">
                            <h3>Kết quả tìm kiếm</h3>
                        </div>

                        @if (!empty($sanPham[0]))
                            <div class="product-content" style="border: none">
                                <div class="row">
                                    <div class="col l-12 m-10 c-12">
                                        <div id="product1" class="product-content_about product-propose_new active">
                                            <div class="row">
                                                @foreach ($sanPham as $sanpham)
                                                    <div class="col-md-4" style="margin: 30px 0px">
                                                        <div class="thumbnail">
                                                            <a
                                                                href="{{ route('pages.chitietsanpham', ['slug'=>$sanpham->slug,'id' => $sanpham->id]) }}">
                                                                <img class="product-propose_new-item_img"
                                                                    src="{{ asset($sanpham->image[0]->url) }}" alt="Lights"
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
                            <h4>Không tìm thấy sản phẩm nào khớp với lựa chọn của bạn.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="product-propose">
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
                                    <img class="product-propose_new-item_img" src="{{ asset($item->image[0]->url) }}"
                                        alt="FURNIBUY">
                                    <p class="product-propose_new-item_info">{{ $item->ten_san_pham }}</p>
                                    <h4 class="product-propose_new-item_price">Giá: {{ number_format($item->gia_ban) }}
                                        VNĐ</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

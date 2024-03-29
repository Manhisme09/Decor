@extends('pages/layouts/layout')
@section('title')
    <title>Danh sách sản phẩm | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <div class="url-title">{{ $danhMuc->ten_danh_muc }}</div>
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu nav-product">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.product', ['id' => $danhMuc->id]) }}">{{ $danhMuc->ten_danh_muc }}</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="filter-product">
            <form method="GET" action="{{ route('pages.product', ['id' => $danhMuc->id]) }}" id="orderForm">
                <select class="select-order" id="orderSelect" name="orderBy">
                    <option value="popularity" @if ($orderBy == "popularity") selected @endif>Phổ biến</option>
                    <option value="name" @if ($orderBy == "name") selected @endif>Sắp xếp theo tên</option>
                    <option value="price" @if ($orderBy == "price") selected @endif>Giá: Tăng dần</option>
                    <option value="price-desc" @if ($orderBy == "price-desc") selected @endif>Giá: Giảm dần</option>
                </select>
            </form>
        </div>
        <div class="sidebar-main">
            <div class="sidebar-content">
                <section id="title-menu">
                    <h2 class="widget-title">Danh mục sản phẩm</h2>
                    <ul id="menu-items">
                        @foreach ($listDanhmuc as $list)
                            <li class="item-menu-product">
                                <a href="{{ route('pages.product', ['id' => $list->id]) }}">{{ $list->ten_danh_muc }}</a>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <div id="woocommerce_price_filter-2" class="widget nasa-widget-store woocommerce widget_price_filter nasa-inited">
                    <div class="widget-title">Lọc theo giá</div>
                    <div class="nasa-open-toggle">
                      <form method="get" action="https://misahouse.com/san-pham/">
                        <div class="price_slider_wrapper">
                          <div id="price_slider" class="price_slider"></div>
                          <div class="price_slider_amount">
                            <input style="display: none" type="text" id="min_price" name="min_price" value="0" data-min="0" placeholder="Giá thấp nhất">
                            <input style="display: none" type="text" id="max_price" name="max_price" value="2350000" data-max="2350000" placeholder="Giá cao nhất">
                            <button style="display: none" type="submit" class="button">Bộ lọc</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="price_label">
                    Giá bán: <span class="from">0&nbsp;VND</span> — <span class="to">2,350,000&nbsp;VND</span>
                  </div>

            </div>
            <div class="main-content">
                <div class="product-container">
                    <div class="grid wide">
                        @if (!empty($sanPham[0]))
                            <div class="product-content" style="border: none">
                                <div class="row">
                                    <div class="col l-12 m-10 c-12">
                                        <div id="product1" class="product-content_about product-propose_new active">
                                            <div class="row" id="product-page-list">
                                                @foreach ($sanPham as $sanpham)
                                                    <div class="col-md-4" style="margin: 30px 0px">
                                                        <div class="thumbnail">
                                                            <a
                                                                href="{{ route('pages.chitietsanpham', ['id' => $sanpham->id, 'slug' => $sanpham->slug]) }}">
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
                                                            <ul class="featured__item__pic__hover">
                                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="{{ route('pages.giohang') }}" onclick="addCart({{ $sanpham->id }})" data-id="{{ $sanpham->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div style="display: none" id="idProductType">{{ $idProductType }}</div>
                                            <div style="display: none" id="orderByProductType">{{ $orderBy }}</div>
                                            <div class="paginate" id="load-more-container">
                                                <span id="icon-load-more-page"><i class="fas fa-sync-alt"></i></span>
                                                <span id="load-more-page">Xem thêm...</span>
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
                    <div class="slick-slider">
                        @foreach ($topSanpham as $item)
                            <div>
                                <div class="product-propose_new-item">
                                    <a href="{{ route('pages.chitietsanpham', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                    <img class="product-propose_new-item_img" src="{{ asset($item->image[0]->url) }}"
                                        alt="FURNIBUY">
                                    <div class="product-top">
                                        <p class="product-propose_new-item_info">{{ $item->ten_san_pham }}</p>
                                        <h4 class="product-propose_new-item_price">Giá: {{ number_format($item->gia_ban) }}
                                            VNĐ</h4>
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
@endsection

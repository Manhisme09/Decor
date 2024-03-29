@extends('pages.layouts.layout')
@section('title')
    <title>Shop bán Đồ decor & Đồ trang trí nhà đẹp, giá rẻ</title>
@endsection
@section('content')

    <div class="rev-slider">
        <div class="fullwidthbanner-container">
            <div class="fullwidthbanner">
                <div class="bannercontainer">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                            <li data-target="#myCarousel" data-slide-to="6"></li>
                            <li data-target="#myCarousel" data-slide-to="7"></li>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img style="width:100%; height:500px" src="{{ asset('images/slide/slide1.jpg') }}" alt="">
                            </div>

                            @foreach ($slide as $item)
                            <div class="item">
                                <img style="width:100%; height:500px" src="{{ asset($item->image) }}" alt="">
                            </div>
                            @endforeach

                            {{-- <div class="item">
                                <img src="{{ asset('images/banner-3.jpg') }}" alt="">
                            </div> --}}
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--slider-->
    </div>
    <div class="main">
        <div class="content">
            @if (!empty($topProduct[0]))
            <div class="product-propose">
                <div class="grid wide">
                    <div class="product-propose_title">
                        <h3 class="product-propose_title-name active">SẢN PHẨM BÁN CHẠY</h3>
                        <div class="line"></div>
                    </div>
            <div class="product-propose_new active">
                <div class="slick-slider">
                    @if (isset($topProduct))
                    @foreach ($topProduct as $top)
                    <div>
                            <div class="product-propose_new-item">
                                <a href="{{ route('pages.chitietsanpham', ['id' => $top->id, 'slug' => $top->slug]) }}">
                                <img class="product-propose_new-item_img" src="{{ asset($top->image[0]->url) }}"
                                    alt="FURNIBUY">
                                <div class="product-top">
                                    <p class="product-propose_new-item_info">{{ $top->ten_san_pham }}</p>
                                    <h4 class="product-propose_new-item_price">Giá:
                                        {{ number_format($top->gia_ban) }} VNĐ</h4>
                                </div>
                                </a>
                            </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
                </div>
            </div>
            @endif
            <!-- product-comtainer1 -->
            <div class="product-container">
                <div class="grid wide">
                    <div class="product-title">
                        <h3>TẤT CẢ SẢN PHẨM</h3>

                    </div>

                    <div class="product-content">
                        <div class="row">
                            <div class="col l-12 m-10 c-12">
                                <div id="product1" class="product-content_about product-propose_new active">
                                    <div class="row" id="product-list">
                                        @if (isset($allProduct))
                                            @foreach ($allProduct as $all)
                                                <div class="col-md-3" style="margin: 30px 0px">
                                                    <div class="thumbnail">
                                                        <a href="{{ route('pages.chitietsanpham', ['slug' => $all->slug, 'id' => $all->id]) }}">
                                                            <img class="product-propose_new-item_img"
                                                                src="{{ asset($all->image[0]->url) }}" alt="Lights"
                                                                style="width:100%">
                                                            <div class="caption">
                                                                <p class="product-propose_new-item_info">
                                                                    {{ $all->ten_san_pham }}</p>
                                                                <h4 class="product-propose_new-item_price">Giá:
                                                                    {{ number_format($all->gia_ban) }} VNĐ</h4>
                                                            </div>
                                                        </a>
                                                        <ul class="featured__item__pic__hover">
                                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="{{ route('pages.giohang') }}" onclick="addCart({{ $all->id }})" data-id="{{ $all->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @endif
                                    </div>
                                    <div class="paginate" id="load-more-container">
                                        <span id="icon-load-more"><i class="fas fa-sync-alt"></i></span>
                                        <span id="load-more">Xem thêm...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- infoStore -->
            <div class="info-store">
                <div class="grid wide">
                    <div class="contact-title">
                        <h3>TIN TỨC NỔI BẬT</h3>
                    </div>

                    <div class="contact-content">
                        <div class="row-post">
                            @foreach ($posts as $post)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="{{ route('pages.baiviet.chitiet', ['id' => $post->id]) }}">
                                            <img src="{{ asset($post->image) }}" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <b>{{ $post->tieu_de }}</b>
                                            </div>
                                            <div class="caption detail">Xem chi tiết</div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

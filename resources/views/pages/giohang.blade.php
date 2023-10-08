@extends('pages.layouts.layout')
@section('title')
    <title>Giỏ hàng | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="cart-title">
                    <h3>GIỎ HÀNG</h3>
                </div>
                <div class="cart-content">
                    <div class="table-responsive">
                        <!-- Shop Products Table -->
                        <table class="table table-bordered" cellspacing="0">
                            <thead>
                                <tr class="table-cart">
                                    <th class="align" style="width:60px">STT</th>
                                    <th class="align">Sản phẩm</th>
                                    <th class="align">Hình ảnh</th>
                                    <th class="align">Giá</th>
                                    <th class="align">Số lượng</th>
                                    <th class="align"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('Cart') != null && Session::get('Cart')->sanpham)
                                    @php
                                        $s = 1;
                                    @endphp
                                    @foreach (Session::get('Cart')->sanpham as $item)
                                        <tr align="center">
                                            <td style="vertical-align: middle">{{ $s++ }}</td>
                                            <td style="vertical-align: middle">{{ $item['sanphamInfo']->ten_san_pham }}</td>
                                            <td><img src="{{ asset($item['sanphamInfo']->image[0]->url) }}" alt=""
                                                    width="150px" height="120px"></td>
                                            <td style="vertical-align: middle; width: 200px"> {{ number_format($item['sanphamInfo']->gia_ban) }} VNĐ</td>

                                            <td style="vertical-align: middle">
                                                {{-- <select name="so_luong" id="select-{{ $item['sanphamInfo']->id }}"
                                                    data-idselect="{{ $item['sanphamInfo']->id }}"
                                                    onchange="updateItemCart({{ $item['sanphamInfo']->id }})"
                                                    style="width: 75px; height:30px">
                                                    @for ($i = 1; $i <= $item['sanphamInfo']->so_luong; $i++)
                                                        <option value="{{ $i }}"
                                                            @if ($i == $item['so_luong']) selected @endif>
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select> --}}
                                                {{-- <div class="quantity buttons_added">
                                                    <input type="number" hidden id="idProduct" value="{{ $item['sanphamInfo']->id }}">
                                                    <input type="number" hidden id="quantityProduct" value="{{ $item['sanphamInfo']->so_luong }}">
                                                    <input type="button" value="-" class="minus button is-form">
                                                    <input type="number" id="quantity" class="input-text qty text" step="1" min="0" max="" name="cart[5589b748dedc01ec8041656653952749][qty]" value="{{ $item['so_luong'] }}" title="Qty" size="4" inputmode="numeric">
                                                    <input type="button" value="+" class="plus button is-form">
                                                </div> --}}

                                                <div class="quantity buttons_added">
                                                    <input type="number" class="productId" value="{{ $item['sanphamInfo']->id }}" hidden>
                                                    <input type="number" class="productQuantity" value="{{ $item['sanphamInfo']->so_luong }}" hidden>
                                                    <input type="number" class="oldQuantity" value="{{ $item['so_luong'] }}" hidden>
                                                    <input type="button" value="-" class="minus button is-form">
                                                    <input type="number" class="input-text qty text productQtyInput" step="1" min="0" max=""
                                                        value="{{ $item['so_luong'] }}" title="Qty" size="4" inputmode="numeric" data-productid="{{ $item['sanphamInfo']->id }}">
                                                    <input type="button" value="+" class="plus button is-form">
                                                </div>

                                            </td>

                                            <td style="vertical-align: middle">
                                                <a class="remove" style="cursor: pointer; color: #f76b6a"
                                                    onclick="deleteCart({{ $item['sanphamInfo']->id }})"
                                                    title="Xoá sản phẩm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>

                                        <td style="font-size: 20px; text-align:center;" colspan="6">Bạn chưa có sản phẩm nào
                                            trong giỏ hàng</td>
                                    </tr>
                                @endif
                                {{-- @else
                    <tr>
                        <td></td>
                        <td style="font-size: 20px">Bạn chưa có sản phẩm nào trong giỏ hàng</td></tr>
                    @endif --}}
                            </tbody>

                        </table>
                        <!-- End of Shop Table Products -->
                    </div>


                    <!-- Cart Collaterals -->

                    @if (Session::has('Cart') != null)
                        <div class="cart-collaterals">

                            <div class="cart-totals pull-right">
                                <div class="cart-totals-row">
                                    <h5 class="cart-total-title">Thanh toán</h5>
                                </div>
                                <div class="cart-totals-row"><span>Tổng số lượng: </span> <span>
                                        @if (isset(Session::get('Cart')->tongsoluong))
                                            {{ number_format(Session::get('Cart')->tongsoluong) }}
                                        @else
                                            0
                                        @endif
                                    </span></div>
                                <div class="cart-totals-row"><span>Tổng tiền: </span> <span>
                                        @if (isset(Session::get('Cart')->tonggia))
                                            {{ number_format(Session::get('Cart')->tonggia) }} VNĐ
                                        @else
                                            0
                                        @endif
                                    </span></div>
                                <div class="cart-totals-row"><a class="btn beta-btn primary"
                                        href="{{ route('pages.thanhtoan') }}" style="margin: 0 130px">Đặt hàng</a></div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    @endif
                    <!-- End of Cart Collaterals -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div> <!-- .container -->

@endsection

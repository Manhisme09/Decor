@extends('pages.layouts.layout')
@section('title')
    <title>{{ $post_detail->tieu_de }}</title>
@endsection
@section('content')

    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <div class="url-title">{{ $post_detail->tieu_de }}</div>
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu nav-product">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.baiviet') }}">Tin tức</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="introduce-content">
                    <br>
                    <img style="margin: 20px 0px" src="{{ asset($post_detail->image) }}" alt="">
                    <div class="introduce-title" style="display: inherit; text-align:center">
                        <h3 style="font-weight:bold; font-size: 30px">{{ $post_detail->tieu_de }}</h3>
                    </div>
                    <br>
                    <br>
                    <p>{!! $post_detail->noi_dung !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

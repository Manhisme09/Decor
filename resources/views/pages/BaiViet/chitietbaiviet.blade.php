@extends('pages.layouts.layout')
@section('title')
    <title>{{ $post_detail->tieu_de }}</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.baiviet') }}">Tin tức</a></span> /
            <span><a
                    href="{{ route('pages.gioithieu', ['id' => $post_detail->id]) }}">{{ $post_detail->tieu_de }}</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="introduce-title">
                    <h3>{{ $post_detail->tieu_de }}</h3>
                </div>
                <div class="introduce-content">
                    <b>{{ $post_detail->tieu_de }}</b>
                    <br>
                    <img style="margin: 20px 0px" src="{{ asset($post_detail->image) }}" alt="">
                    <p>{!! $post_detail->noi_dung !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('pages.layouts.layout')
@section('title')
    <title>Tin tức | Nội thất Funibuy</title>
@endsection
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tin tức</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main">
            <div class="grid wide">
                <div class="contact-title">
                    <h3>TIN TỨC </h3>
                </div>
                <div class="contact-content">
                    <div>
                        <div class="row-post">
                            @foreach ($baiviet as $bv)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <a href="{{ route('pages.baiviet.chitiet', ['id' => $bv->id]) }}">
                                            <img src="{{ asset($bv->image) }}" alt="Lights" style="width:100%">
                                            <div class="caption">
                                                <b>{{ $bv->tieu_de }}</b>
                                            </div>
                                            <div class="caption detail"> Xem chi tiết </div>
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

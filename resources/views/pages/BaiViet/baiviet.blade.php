@extends('pages.layouts.layout')
@section('title')
    <title>Tin tức | Nội thất Funibuy</title>
@endsection
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.baiviet') }}">Tin tức</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="contact-title">
                    <h3>TIN TỨC </h3>
                </div>
                <div class="contact-content">
                    {{-- <div class="col-sm-3" style="background-color: #ccc; height:150px"></div> --}}
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

@extends('pages.layouts.layout')
@section('title')
    <title>Hoàn thành đặt hàng | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="jumbotron jumbotron-fluid mt-5 mb-5" style="margin: 50px 0">
        <div class="container">
            <h1 class="display-4">ĐẶT HÀNG THÀNH CÔNG!</h1>
            @if ($vnpay)
            <p class="lead" style="margin-top: 50px;">Đơn hàng sẽ được giao đến bạn !</p>
            @endif
            <p class="lead" style="margin-top: 50px;">Cảm ơn bạn đã sử dụng dịch vụ!!</p>
        </div>
    </div>
@endsection

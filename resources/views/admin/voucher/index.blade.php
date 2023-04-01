@extends('admin.layouts.layout')

@section('head')
    <title>Quản lý phiếu giảm giá</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách phiếu giảm giá</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a class="btn btn-primary" href="{{ route('admin.voucher.getThem') }}"> <i class="fa fa-plus"></i>Thêm
                    mới</a>
            <p>
        </div>
    </div>
    @if (session('thongbao'))
    <div class="alert alert-success">{{ session('thongbao') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách phiếu giảm giá
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã giảm giá</th>
                                    <th>Mệnh giá</th>
                                    <th>Số lượng</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($voucher))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($voucher as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->ma_giam_gia }}</td>
                                            <td>{{ number_format($item->gia_tien) }} VNĐ</td>
                                            <td>{{ $item->so_luong }}</td>
                                            <td>{{ $item->ngay_bat_dau }}</td>
                                            <td>{{ $item->ngay_ket_thuc }}</td>
                                            <td class="" style="">
                                                <a class="btn btn-warning btn-xs" href="{{ route('admin.voucher.getSua', ['id'=>$item->id]) }}" ​><i class="fa fa-edit"></i>
                                                    Sửa</a>
                                                <a class="btn btn-danger btn-xs" href="{{ route('admin.voucher.xoa', ['id'=>$item->id]) }}" onclick="return ConfirmDelete()"
                                                    ​><i class="fa fa-trash-o  fa-fw"></i>
                                                    Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection

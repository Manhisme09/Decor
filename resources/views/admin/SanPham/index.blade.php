@extends('admin.layouts.layout')

@section('head')
    <title>Danh sách sản phẩm</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    @if (session('thongbao'))
    <div class="alert alert-success">{{ session('thongbao') }}</div>
    @endif

    @if (session('loi'))
    <div class="alert alert-danger">{{ session('loi') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a class="btn btn-primary" href="{{ route('admin.SanPham.getThem') }}"> <i class="fa fa-plus"></i>
                    Thêm sản phẩm</a>
            <p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách sản phẩm
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th style="min-width: 10px">STT</th>
                                    <th>Danh mục</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Đã bán</th>
                                    <th>Giá bán</th>
                                    <th style="min-width: 85px">Chức năng</th>
                            </thead>
                            <tbody>
                                @if (isset($sanpham))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($sanpham as $sp)
                                        <tr class="odd gradeX">
                                            <td class="" style="width: 80px; text-align: center;">
                                                {{ $i++ }}</td>
                                            <td class="" style="font-weight: 600; color: rgb(231, 38, 38)">
                                                {{ $sp->danh_muc ? $sp->danh_muc->ten_danh_muc : '' }}</td>
                                            <td class="" style="width: 80px; text-align: center;">
                                                {{ $sp->ten_san_pham }}
                                            </td>
                                            <td class="" style="">
                                                @if(isset($sp->image[0]))
                                                <img src="{{ asset($sp->image[0]->url) }}" alt="" srcset="" width="220px" height="150px">
                                                 @endif
                                            </td>
                                            <td class="" style="">{{ $sp->so_luong }}</td>
                                            <th>{{ $sp->da_ban }}</th>
                                            <td class="" style="">{{ number_format($sp->gia_ban) }} VNĐ</td>
                                            <td class="center" style="text-align: center;">
                                                <a class="btn btn-warning btn-xs btn-edit"
                                                    href="{{ route('admin.SanPham.getSua', ['id' => $sp->id]) }}"><i
                                                        class="fa fa-edit"></i> Sửa</a>
                                                <a class="btn btn-danger btn-xs"
                                                    href="{{ route('admin.SanPham.getXoa', ['id' => $sp->id]) }}"
                                                    onclick="return ConfirmDelete()"><i class="fa fa-trash-o  fa-fw"></i>
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

@section('script')
@endsection

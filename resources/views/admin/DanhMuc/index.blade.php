@extends('admin.layouts.layout')

@section('head')
    <title>Quản lý danh mục</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách danh mục</h1>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        </div>
    @endif
    @if (session('thongbao'))
        <div class="alert alert-success">
            {{ session('thongbao') }}
        </div>
    @endif
    @if (session('loi'))
    <div class="alert alert-danger">
        {{ session('loi') }}
    </div>
@endif
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a class="btn btn-primary" href="{{ route('admin.DanhMuc.getThem') }}"> <i class="fa fa-plus"></i> Thêm
                    mới</a>
            <p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách danh mục
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>

                                <tr>
                                    <th style="width: 15px">STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($danhmuc as $muc)
                                    <tr class="odd gradeX">
                                        <td>{{ $i++ }}</td>
                                        @if ($muc->parent_id === 0)
                                            <td class=""><b>{{ $muc->ten_danh_muc }}</b></td>
                                        @else
                                            <td class="">-- {{ $muc->ten_danh_muc }}</td>
                                        @endif
                                        <td class="" style="">
                                            <a class="btn btn-warning btn-xs"
                                                href="{{ route('admin.DanhMuc.getSua', ['id' => $muc->id]) }}" ​><i
                                                    class="fa fa-edit"></i> Sửa</a>
                                            <a class="btn btn-danger btn-xs"
                                                href="{{ route('admin.DanhMuc.getXoa', ['id' => $muc->id]) }}"
                                                onclick="return ConfirmDeleteCate()" ​><i class="fa fa-trash-o  fa-fw"></i>
                                                Xoá</a>
                                        </td>
                                    </tr>
                                @endforeach
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

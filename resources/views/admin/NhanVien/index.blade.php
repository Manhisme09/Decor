@extends('admin.layouts.layout')

@section('head')
    <title>Quản lý nhân viên</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách tài khoản nhân viên</h1>
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
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a class="btn btn-primary" href="{{ route('admin.nhanvien.getThem') }}"> <i class="fa fa-plus"></i> Thêm
                    mới</a>
                    <a class="btn btn-primary" href="{{ route('admin.nhanvien.export') }}"><i class="fa fa-download" aria-hidden="true"></i> Xuất danh sách</a>
            <p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách tài khoản nhân viên
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($nhanvien))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($nhanvien as $nv)
                                        <tr class="odd gradeX">
                                            <td class="" style="width: 80px; text-align: center;">
                                                {{ $i++ }}
                                            </td>
                                            <td class="">{{ $nv->admin->ho_ten }}</td>
                                            <td class="" style="">{{ $nv->email }}</td>
                                            <td class="" style="">
                                                {{ date('d/m/Y', strtotime($nv->admin->ngay_sinh)) }}</td>
                                            <td class="" style="">{{ $nv->admin->gioi_tinh }}</td>
                                            <td class="" style="">{{ $nv->admin->dien_thoai }}</td>
                                            <td class="" style="">{{ $nv->admin->dia_chi }}</td>
                                            <td class="" style="">
                                                <a class="btn btn-warning btn-xs"
                                                    href="{{ route('admin.nhanvien.getSua', ['id' => $nv->id]) }}" ​><i
                                                        class="fa fa-edit"></i> Sửa</a>
                                                <a class="btn btn-danger btn-xs" onclick=" return ConfirmDelete()"
                                                    href="{{ route('admin.nhanvien.xoa', ['id' => $nv->id]) }}"><i
                                                        class="fa fa-trash-o  fa-fw"></i> Xoá</a>
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

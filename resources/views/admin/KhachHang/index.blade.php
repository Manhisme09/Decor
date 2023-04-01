@extends('admin.layouts.layout')

@section('head')
    <title>Quản lý khách hàng</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách tài khoản khách hàng</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách tài khoản khách hàng
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
                                    <th>Số điện thoại</th>
                                    <th>Ngày sinh</th>
                                    <th>Địa chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($khachhang))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($khachhang as $kh)
                                        <tr class="odd gradeX">
                                            <td class="" style="width: 80px; text-align: center;">
                                                {{ $i++ }}</td>
                                            <td class="">{{ $kh->khach_hang->ho_ten }}</td>
                                            <td class="" style="">{{ $kh->email }}
                                            </td>
                                            <td class="" style="">{{ $kh->khach_hang->dien_thoai }}</td>
                                            <td class="" style="">
                                                {{ date('d/m/Y', strtotime($kh->khach_hang->ngay_sinh)) }}</td>
                                            <td class="" style="">{{ $kh->khach_hang->dia_chi }}</td>
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

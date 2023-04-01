@extends('pages.layouts.layout')
@section('content')
    <div class="container">
        <div class="mapping">
            <span><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></span> /
            <span><a href="{{ route('pages.getdonhang') }}">Danh sách đơn hàng</a></span>
        </div>
        <div class="main">
            <div class="grid wide">
                <div class="profile-title">
                    <h3>DANH SÁCH ĐƠN HÀNG</h3>
                </div>
                <div class="profile-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    @if (Session('login'))
                                        <table class="table table-striped table-bordered table-hover" id="table-admin">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã hoá đơn</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders))
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($orders as $od)
                                                        <tr class="odd gradeX">
                                                            <td>{{ $i++ }}</td>
                                                            <td><b> HD{{ $od->id }}</b></td>
                                                            <td>{{ date('d-m-Y', strtotime($od->ngay_lap)) }}</td>
                                                            <td>{{ number_format($od->tong_tien) }} VNĐ</td>
                                                            <td>
                                                                @if ($od->status == 0)
                                                                    <span style="color: rgb(25, 46, 231)">Chờ xác
                                                                        nhận</span>
                                                                @elseif ($od->status == 1)
                                                                    <span style="color: green">Đã xác nhận</span>
                                                                @elseif($od->status == 2)
                                                                    <span style="color: green">Đang giao hàng</span>
                                                                @elseif($od->status == 3)
                                                                    <span style="color: green">Đã thanh toán</span>
                                                                @elseif($od->status == -1)
                                                                    <span style="color: red">Đơn hàng đã bị huỷ</span>
                                                                @elseif($od->status == -2)
                                                                    <span style="color: red">Giao hàng không thành
                                                                        công</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($od->status == 0)
                                                                    <a href="{{ route('pages.Huy', ['id' => $od->id]) }}"
                                                                        class="btn btn-danger"
                                                                        style="background-color: red">Huỷ đơn hàng</a>
                                                                @else
                                                                    <span>Không thể huỷ đơn hàng</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    @else
                                        <table class="table table-striped table-bordered table-hover" id="table-admin">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Mã hoá đơn</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Tổng tiền</th>
                                                    <th>Trạng thái đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($hoadon))
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($hoadon as $hd)
                                                        <tr class="odd gradeX">
                                                            <td>{{ $i++ }}</td>
                                                            <td><b> HD{{ $hd->id }}</b></td>
                                                            <td>{{ date('d-m-Y', strtotime($hd->ngay_lap)) }}</td>
                                                            <td>{{ number_format($hd->tong_tien) }} VNĐ</td>
                                                            <td>
                                                                @if ($hd->status == 0)
                                                                    <span style="color: rgb(25, 46, 231)">Chờ xác
                                                                        nhận</span>
                                                                @elseif ($hd->status == 1)
                                                                    <span style="color: green">Đã xác nhận</span>
                                                                @elseif($hd->status == 2)
                                                                    <span style="color: green">Đang giao hàng</span>
                                                                @elseif($hd->status == 3)
                                                                    <span style="color: green">Đã thanh toán</span>
                                                                @elseif($hd->status == -1)
                                                                    <span style="color: red">Đơn hàng đã bị huỷ</span>
                                                                @elseif($hd->status == -2)
                                                                    <span style="color: red">Giao hàng không thành
                                                                        công</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($hd->status == 0)
                                                                    <a href="{{ route('pages.Huy', ['id' => $hd->id]) }}"
                                                                        class="btn btn-danger">Huỷ đơn hàng</a>
                                                                @else
                                                                    <span>Không thể huỷ đơn hàng</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="space90">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

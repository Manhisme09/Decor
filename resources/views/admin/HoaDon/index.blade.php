@extends('admin.layouts.layout')

@section('head')
    <title>Danh sách hoá đơn</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách hoá đơn</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách hoá đơn
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table-admin">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã hoá đơn</th>
                                    <th>Họ tên khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($hoadon))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($hoadon as $hd)
                                        <tr class="odd gradeX">
                                            <td class="" style="width: 80px; text-align: center;">
                                                {{ $i++ }}</td>
                                            <td style="text-align: center; color: red"><b>HD{{ $hd->id }}</b></td>
                                            <td>{{ $hd->khach_hang ? $hd->khach_hang->ho_ten : '' }}</td>
                                            <td>{{ $hd->tong_tien }}</td>
                                            <td>{{ date('d-m-Y', strtotime($hd->ngay_lap)) }}</td>
                                            <td>
                                                @if ($hd->status == 0)
                                                    Chưa xác nhận | <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.hoadon.acceptOrder', ['id' => $hd->id]) }}"><i
                                                            class="fa fa-check"></i> Xác nhận</a>
                                                @elseif($hd->status == 1)
                                                    Đã xác nhận | <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.hoadon.startShip', ['id' => $hd->id]) }}"><i
                                                            class="fas fa-shipping-fast"></i> Bắt đầu giao hàng</a>
                                                @elseif($hd->status == 2)
                                                    Đã giao hàng |
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.hoadon.cancelShip', ['id' => $hd->id]) }}"><i
                                                            class="fa fa-close"></i> Giao hàng không thành công</a> |
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.hoadon.acceptPayment', ['id' => $hd->id]) }}"><i
                                                            class="fa fa-check-circle"></i> Xác nhận thanh toán</a>
                                                @elseif($hd->status == 3)
                                                    <b style="color: green;">ĐÃ THANH TOÁN</b>
                                                @elseif($hd->status == -1)
                                                    <b style="color: red;">ĐƠN HÀNG ĐÃ BỊ HUỶ</b>
                                                @elseif($hd->status == -2)
                                                    <b style="color: red;">GIAO HÀNG KHÔNG THÀNH CÔNG</b> | <a
                                                        class="btn btn-success btn-xs"
                                                        href="{{ route('admin.hoadon.startShip', ['id' => $hd->id]) }}"><i
                                                            class="fa fa-sign-out"></i> Giao lại</a> | <a
                                                        class="btn btn-danger btn-xs"
                                                        href="{{ route('admin.hoadon.AdmincancelOrder', ['id' => $hd->id]) }}"><i
                                                            class="fa fa-ban"></i> Huỷ</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-xs btn-view" href="#"
                                                    data-url="{{ route('admin.hoadon.getView', ['id' => $hd->id]) }}" ​><i
                                                        class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                                <a class="btn btn-success btn-xs"
                                                    href="{{ route('admin.hoadon.inhoadon', ['id' => $hd->id]) }}"><i
                                                        class="fa fa-print" aria-hidden="true"></i> In hoá đơn</a>
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
    @include('admin.HoaDon.modal_view')

@endsection

@section('script')
    <script>
        $('.btn-view').click(function(e) {
            var url = $(this).attr('data-url');
            $('#modal-view').modal('show');
            e.preventDefault();
            $.ajax({
                //phương thức get
                type: 'get',
                url: url,
                success: function(response) {
                    data = response.data
                    $('.hoa_don_id').text('HD' + data.id);
                    $('#ngay_dat').text(data.ngay_lap);
                    $('#khach_hang').text(data.khach_hang.ho_ten);
                    $('#dia_chi').text(data.khach_hang.dia_chi);
                    $('#dien_thoai').text(data.khach_hang.dien_thoai);
                    $('#table-body').html('');
                    totalPrice = 0;
                    data.chi_tiet_hoa_don.forEach((element, index) => {
                        if (element.san_pham != null) {
                            html = `
                                <tr>
                                    <td>${index+1}</td>
                                    <td>${element.san_pham.ten_san_pham}</td>
                                    <td>${element.so_luong}</td>
                                    <td>${element.don_gia} VNĐ</td>
                                    <td>${element.thanh_tien} VNĐ</td>
                                </tr>
                            `
                        } else {
                            html = `
                                <tr>
                                    <td>${index+1}</td>
                                    <td>Sản phẩm đã bị xoá</td>
                                    <td>${element.so_luong}</td>
                                    <td>${element.don_gia} VNĐ</td>
                                    <td>${element.thanh_tien} VNĐ</td>
                                </tr>
                            `
                        }
                        $('#table-body').append(html);
                        totalPrice += element.thanh_tien
                    });

                    $('#tong_tien').text(totalPrice + ' VNĐ');



                },
                error: function(error) {
                    alert("Lỗi lấy dữ liệu!")
                }
            })
        })
    </script>
@endsection

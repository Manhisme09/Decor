@extends('pages.layouts.layout')
@section('content')
    <div class="banner-head">
        <div class="banner-head">
            <div class="url-main">
                <nav aria-label="breadcrumb row">
                    <ol class="breadcrumb url-menu">
                        <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
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
                                        <table class="table table-striped table-bordered table-hover table-order" id="table-admin">
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
                                                                <a class="btn beta-btn-view primary btn-xs btn-view-order"
                                                                data-url="{{ route('pages.order.detail', ['id' => $hd->id]) }}" ​><i
                                                                    class="fa fa-eye" aria-hidden="true"></i> Xem chi tiết</a>
                                                            </td>
                                                            <td>
                                                                @if ($hd->status == 0)
                                                                    <a href="{{ route('pages.Huy', ['id' => $hd->id]) }}"
                                                                     class="btn beta-btn primary">Huỷ đơn hàng</a>
                                                                @else
                                                                    <span>Không thể huỷ đơn hàng</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    <div class="space90">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.taikhoan.modal_order_view')
@endsection

@section('script')
    <script>
        jQuery.noConflict();
        $('.btn-view-order').click(function(e) {
            var url = $(this).attr('data-url');
            window.$('#modal_order_view').modal();
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
                    function formatCurrency(amount) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(amount);
                    }

                    data.chi_tiet_hoa_don.forEach((element, index) => {
                        const tenSanPham = element.san_pham ? element.san_pham.ten_san_pham : 'Sản phẩm đã bị xoá';
                        const donGiaFormatted = formatCurrency(element.don_gia);
                        const thanhTienFormatted = formatCurrency(element.thanh_tien);

                        const html = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${tenSanPham}</td>
                                <td>${element.so_luong}</td>
                                <td>${donGiaFormatted}</td>
                                <td>${thanhTienFormatted}</td>
                            </tr>
                        `;

                        $('#table-body').append(html);
                        totalPrice += element.thanh_tien;
                    });

                    $('#tong_tien').text(formatCurrency(totalPrice));



                },
                error: function(error) {
                    alert("Lỗi lấy dữ liệu!")
                }
            })
        })
    </script>
@endsection

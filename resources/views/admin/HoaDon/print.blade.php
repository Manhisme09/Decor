<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoá Đơn</title>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }

        .header {
            text-align: center;
        }

        table {
            font-size: 17px;
            margin-bottom: 30px;
        }

        #chi-tiet {
            border-collapse: collapse;
        }

        #chi-tiet,
        #chi-tiet th,
        #chi-tiet td {
            border: 1px solid black;
            padding: 5px 10px;
            font-size: 14px;
        }

        .tr-nhap,
        .tr-nhap td {
            border: 1px solid black;
            padding: 10px 10px;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <div class="header">
        <h2>CỬA HÀNG NỘI THẤT FURNIBUY.COM</h2>
        <p>Đ/C: Số 211 Vũ Tông Phan – Thanh Xuân – Hà Nội</p>
        <p>ĐT: 0858.901.689</p>
        <h2>HOÁ ĐƠN BÁN HÀNG</h2>
    </div>

    <div class="main">
        <table>
            <tr>
                <th style="padding-right: 30px">Mã hoá đơn: </th>
                <td style="padding-left: 20px; text-align: left;">HD{{ $hd->id }}</td>
            </tr>
            <tr>
                <th style="padding-right: 30px">Khách hàng: </th>
                <td style="padding-left: 20px; text-align: left;">{{ $hd->khach_hang ? $hd->khach_hang->ho_ten : '' }}</td>
            </tr>
            <tr>
                <th style="padding-right: 45px">Điện thoại: </th>
                <td style="padding-left: 20px; text-align: left;">{{ $hd->khach_hang ? $hd->khach_hang->dien_thoai : '' }}
                </td>
            </tr>
            <tr>
                <th style="padding-right: 75px">Địa chỉ: </th>
                <td style="padding-left: 20px; text-align: left;">{{ $hd->khach_hang ? $hd->khach_hang->dia_chi : '' }}</td>
            </tr>
            <tr>
                <th style="padding-right: 55px">Ngày lập: </th>
                <td style="padding-left: 20px; text-align: left;">{{ date('d-m-Y', strtotime($hd->ngay_lap)) }}</td>
            </tr>
        </table>
        <table id="chi-tiet">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    </th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($cthd))
                    <?php $i = 1; ?>
                    @foreach ($cthd as $item)
                        <tr class="tr-nhap">
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->san_pham ? $item->san_pham->ten_san_pham : '' }}</td>
                            <td>{{ $item->so_luong }}</td>
                            <td>{{ number_format($item->don_gia) }} VNĐ</td>
                            <td>{{ number_format($item->thanh_tien) }} VNĐ</td>
                        </tr>
                    @endforeach
                    <tr class="tr-nhap">
                        <td colspan="4" style="text-align: center"><b>Tổng cộng</b></td>
                        <td>{{ number_format($item->hoa_don ? $item->hoa_don->tong_tien : '') }} VNĐ</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>

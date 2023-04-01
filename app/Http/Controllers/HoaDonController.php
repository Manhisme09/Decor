<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF;
use App\Models\SanPham;

class HoaDonController extends Controller
{
    public function index()
    {
        $hoadon = HoaDon::orderBy('id', 'desc')->get();
        return view('admin.HoaDon.index', compact('hoadon'));
    }

    public function acceptOrder($id)
    {
        $hoadon = HoaDon::find($id);
        $hoadon->status = 1;
        $hoadon->update();
        return redirect()->back()->with('thongbao', 'Xác nhận đơn hàng HD' . $hoadon->id . 'thành công');
    }

    public function startShip($id)
    {
        $hoadon = HoaDon::find($id);
        $hoadon->status = 2;
        $hoadon->update();
        return redirect()->back()->with('thongbao', 'Đơn hàng HD' . $hoadon->id . 'đã được giao');
    }

    public function cancelOrder($id)
    {
        $hoadon = HoaDon::find($id);
        if ($hoadon->status == 0 && $hoadon->khach_hang_id = \Auth::user()->khach_hang->id) {
            $hoadon->status = -1;
            $hoadon->update();
            $hoadonhuy = HoaDon::with('chi_tiet_hoa_don.san_pham')->find($id);
            // dd($hoadonhuy);
            if ($hoadonhuy->status === -1) {
                foreach ($hoadonhuy->chi_tiet_hoa_don as $value) {
                    //  dd($value->san_pham_id);
                    $sanpham = SanPham::where('id', $value->san_pham_id)->get();
                    // dd($sanpham);
                    foreach ($sanpham as $sp) {
                        $sp->so_luong += $value->so_luong;
                        $sp->da_ban -= $value->so_luong;
                        // $sanpham->da_ban -= $value['so_luong'];
                        $sp->save();
                    }
                }
            }
            return redirect()->back()->with('thongbao', 'Đơn hàng HD' . $hoadon->id . ' đã được huỷ!');
        } elseif ($hoadon->status == -2) {
            $hoadon->status = -1;
            $hoadon->update();
            $hoadonhuy = HoaDon::with('chi_tiet_hoa_don.san_pham')->find($id);
            // dd($hoadonhuy);
            if ($hoadonhuy->status === -1) {
                foreach ($hoadonhuy->chi_tiet_hoa_don as $value) {
                    //  dd($value->san_pham_id);
                    $sanpham = SanPham::where('id', $value->san_pham_id)->get();
                    // dd($sanpham);
                    foreach ($sanpham as $sp) {
                        $sp->so_luong += $value->so_luong;
                        $sp->da_ban -= $value->so_luong;
                        // $sanpham->da_ban -= $value['so_luong'];
                        $sp->save();
                    }
                }
            }
            return redirect()->back()->with('thongbao', 'Đơn hàng HD' . $hoadon->id . ' đã được huỷ!');
        }
    }

    public function cancelShip($id)
    {
        $hoadon = HoaDon::find($id);
        $hoadon->status = -2;
        $hoadon->update();
        return redirect()->back()->with('thongbao', 'Đơn hàng HD' . $hoadon->id . ' giao hàng không thành công, chờ giao lại!');
    }

    public function acceptPayment($id)
    {
        $hoadon = HoaDon::find($id);
        $hoadon->status = 3;
        $hoadon->update();
        return redirect()->back()->with('thongbao', 'Đơn hàng HD' . $hoadon->id . ' đã được thanh toán!');
    }

    public function getView($id)
    {
        $hoadon = HoaDon::find($id);
        $respone = array('data' => $hoadon);

        $khach_hang = $hoadon->khach_hang;
        $respone['data']['khach_hang'] = $khach_hang;

        foreach ($hoadon->chi_tiet_hoa_don as $item) {
            $respone['data']['chi_tiet_hoa_don'] = $item;
            //   dd($item->san_pham);
            if ($item->san_pham) {
                foreach ($item->san_pham as $item2) {
                }
            } else {
                $respone['data']['chi_tiet_hoa_don']['san_pham'] = "Không tồn tại";
            }
        }
        return $respone;
    }

    public function print($id)
    {
        $hd = HoaDon::find($id);
        $cthd = ChiTietHoaDon::where('hoa_don_id', $id)->get();
        $pdf = PDF::loadView('admin.HoaDon.print',  compact('hd', 'cthd'));

        $title = 'HD' . $id . '-ngay-xuat-' . $hd->ngay_lap . '.pdf';
        return $pdf->stream($title);
        // return $pdf->download('hoadon.pdf');
    }
}

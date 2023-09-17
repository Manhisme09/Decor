<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Cart;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\ChiTietHoaDon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CartController extends Controller
{
    public function getCart()
    {
        return view('pages.giohang');
    }

    public function addCart(Request $request, $id)
    {
        $sanPham = SanPham::find($id);
        if ($sanPham != null) {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($sanPham, $id);
            $request->session()->put('Cart', $newCart);
        }
        Toastr::success('Sản phẩm đã được thêm vào giỏ hàng !', 'Thành công');
        return view('pages.giohang', compact('newCart'));
    }

    public function updateCart(Request $request, $id, $tong)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id, $tong);
        $request->Session()->put('Cart', $newCart);
        Toastr::success('Cập nhật giỏ hàng thành công !', 'Thành công');
        return redirect()->route('pages.giohang');
    }

    public function deleteCart(Request $request, $id)
    {
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteItemCart($id);
        if (count($newCart->sanpham) > 0) {
            $request->Session()->put('Cart', $newCart);
        } else {
            $request->Session()->forget('Cart');
        }
        Toastr::success('Đã xoá sản phẩm khỏi giỏ hàng !', 'Thành công');
        return redirect()->route('pages.giohang');
    }

    public function getPayment()
    {
        return view('pages.thanhtoan');
    }

    public function postPayment(Request $request)
    {
        $this->validate($request, [
            'ho_ten' => 'required',
            'ngay_sinh' => 'required|date|before:today',
            'dien_thoai' => 'required|numeric',
            'dia_chi' => 'required',
        ], [
            'ho_ten.required' => 'Bạn chưa nhập họ tên',
            'ngay_sinh.required' => 'Bạn chưa nhập ngày sinh',
            'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
            'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
            'dien_thoai.required' => 'Bạn chưa nhập số điện thoại',
            'dien_thoai.numerric' => 'Số điện thoại phải là số',
            'dia_chi.required' => 'Bạn chưa nhập địa chỉ',
        ]);

        $khachhang = KhachHang::find(Auth::user()->khach_hang->id);
        $khachhang->ho_ten = $request->ho_ten;
        $khachhang->ngay_sinh = $request->ngay_sinh;
        $khachhang->dien_thoai = $request->dien_thoai;
        $khachhang->dia_chi = $request->dia_chi;
        $khachhang->save();

        $cart = \Session::get('Cart');
        $hoadon = new HoaDon();
        $hoadon->khach_hang_id = $khachhang->id;
        $hoadon->ngay_lap = \Carbon\Carbon::now();
        $hoadon->tong_tien = $cart->tonggia;
        $hoadon->save();

        foreach ($cart->sanpham as $key => $value) {
            $cthd = new ChiTietHoaDon();
            $cthd->hoa_don_id = $hoadon->id;
            $cthd->san_pham_id = $key;
            $cthd->so_luong = $value['so_luong'];
            $cthd->don_gia = $value['gia_ban'] / $value['so_luong'];
            $cthd->thanh_tien = $value['so_luong'] * ($value['gia_ban'] / $value['so_luong']);
            $cthd->save();
        }

        $request->Session()->forget('Cart');
        return redirect()->route('pages.thongbao');
    }

    public function postPayment2(Request $request)
    {
        $this->validate($request, [
            'ho_ten' => 'required',
            'ngay_sinh' => 'required|date|before:today',
            'dien_thoai' => 'required|numeric',
            'dia_chi' => 'required',
        ], [
            'ho_ten.required' => 'Bạn chưa nhập họ tên',
            'ngay_sinh.required' => 'Bạn chưa nhập ngày sinh',
            'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
            'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
            'dien_thoai.required' => 'Bạn chưa nhập số điện thoại',
            'dien_thoai.numerric' => 'Số điện thoại phải là số',
            'dia_chi.required' => 'Bạn chưa nhập địa chỉ',
        ]);

        $khachhang = KhachHang::find(Session('login'));
        $khachhang->ho_ten = $request->ho_ten;
        $khachhang->ngay_sinh = $request->ngay_sinh;
        $khachhang->dien_thoai = $request->dien_thoai;
        $khachhang->dia_chi = $request->dia_chi;
        $khachhang->save();

        $cart = \Session::get('Cart');
        $hoadon = new HoaDon();
        $hoadon->khach_hang_id = $khachhang->id;
        $hoadon->ngay_lap = \Carbon\Carbon::now();
        $hoadon->tong_tien = $cart->tonggia;
        $hoadon->save();

        foreach ($cart->sanpham as $key => $value) {
            $cthd = new ChiTietHoaDon();
            $cthd->hoa_don_id = $hoadon->id;
            $cthd->san_pham_id = $key;
            $cthd->so_luong = $value['so_luong'];
            $cthd->don_gia = $value['gia_ban'] / $value['so_luong'];
            $cthd->thanh_tien = $value['so_luong'] * ($value['gia_ban'] / $value['so_luong']);
            $cthd->save();

            $sanpham = SanPham::find($key);
            $sanpham->so_luong -= $value['so_luong'];
            $sanpham->da_ban += $value['so_luong'];
            $sanpham->save();
        }

        $request->Session()->forget('Cart');
        return redirect()->route('pages.thongbao');
    }

    public function notify()
    {
        return view('pages.thongbao');
    }
}

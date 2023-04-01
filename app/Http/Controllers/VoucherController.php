<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(){
        $voucher = Voucher::orderBy('id', 'asc')->get();
        return view('admin.voucher.index', compact('voucher'));
    }

    public function getThem(){
        return view('admin.voucher.them');
    }

    public function postThem(Request $request){
        $this->validate($request, [
            'ma_giam_gia' => 'required',
            'so_tien' => 'required',
            'so_luong' => 'required|numeric|min:0',
        ], [
            'ma_giam_gia.required' => 'Bạn chưa nhập mã giảm giá!',
            'so_tien.required' => 'Bạn chưa nhập số tiền giảm!',
            'so_luong.required' => 'Bạn chưa nhập số lượng phiếu!',
            'so_luong.numeric' => 'Vui lòng nhập số!',
            'so_luong.min' => 'Số lượng không âm!',
        ]);
        $voucher = new Voucher();
        $voucher->ma_giam_gia = $request->ma_giam_gia;
        $voucher->gia_tien = $request->so_tien;
        $voucher->so_luong = $request->so_luong;
        $voucher->ngay_bat_dau = $request->ngay_bat_dau;
        $voucher->ngay_ket_thuc = $request->ngay_ket_thuc;
        $voucher->save();
        return redirect()->back()->with('thongbao','Thêm phiếu giảm giá thành công!');
    }

    public function getSua($id){
        $voucher = Voucher::find($id);
        return view('admin.voucher.sua', compact('voucher'));
    }

    public function postSua(Request $request ,$id){
        $this->validate($request, [
            'ma_giam_gia' => 'required',
            'so_tien' => 'required',
            'so_luong' => 'required|numeric|min:0',
        ], [
            'ma_giam_gia.required' => 'Bạn chưa nhập mã giảm giá!',
            'so_tien.required' => 'Bạn chưa nhập số tiền giảm!',
            'so_luong.required' => 'Bạn chưa nhập số lượng phiếu!',
            'so_luong.numeric' => 'Vui lòng nhập số!',
            'so_luong.min' => 'Số lượng không âm!',
        ]);
        $voucher = Voucher::find($id);
        $voucher->ma_giam_gia = $request->ma_giam_gia;
        $voucher->gia_tien = $request->so_tien;
        $voucher->so_luong = $request->so_luong;
        $voucher->ngay_bat_dau = $request->ngay_bat_dau;
        $voucher->ngay_ket_thuc = $request->ngay_ket_thuc;
        $voucher->save();
        return redirect()->route('admin.voucher.index')->with('thongbao', 'Đã cập nhật phiếu giảm giá!');
    }

    public function xoa($id){
        Voucher::destroy($id);
        return redirect()->back()->with('thongbao', 'Đã xoá phiếu giảm giá!');
    }
}

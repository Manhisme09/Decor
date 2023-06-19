<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\SanPham;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\UpdateProfileUserRequest;
use App\Http\Requests\UpdatePasswordUserRequest;

class TaiKhoanController extends Controller
{
    public function getUserProfile()
    {
        return view('pages.taikhoan.thongtin');
    }
    public function postUserProfile(UpdateProfileUserRequest $request)
    {
        $khachHang = KhachHang::find(Auth::user()->khach_hang->id);
        $khachHang->ho_ten = $request->ho_ten;
        $khachHang->dien_thoai = $request->dien_thoai;
        $khachHang->ngay_sinh = $request->ngay_sinh;
        $khachHang->dia_chi = $request->dia_chi;
        $khachHang->update();
        Toastr::success('Cập nhập thông tin thành công', 'Thành công');
        return redirect()->back();
    }

    // public function postUserProfileGoogle(Request $request){
    //     $khachHang = KhachHang::find(Session('id'));
    //     $khachHang->ho_ten = $request->ho_ten;
    //     $khachHang->dien_thoai = $request->dien_thoai;
    //     $khachHang->ngay_sinh = $request->ngay_sinh;
    //     $khachHang->dia_chi = $request->dia_chi;
    //     $khachHang->save();
    //     return redirect()->back()->with('thongbao', 'Thông tin đã được thay đổi');
    // }

    public function getUserPassword()
    {
        return view('pages.taikhoan.matkhau');
    }
    public function postUserPassword(UpdatePasswordUserRequest $request)
    {
        $user = Auth::user();
        if (!(Hash::check($request->oldPassword, $user->password))) {
            Toastr::error('Mật khẩu cũ không chính xác!');
            return redirect()->back();
        }
        $user->password = bcrypt($request->password);
        $user->update();
        Toastr::success('Thay đổi mật khẩu thành công!', 'Thành công');
        return redirect()->back();
    }
    public function getUserOrder()
    {
        // dd(Session('login'));
        if (Session('login')) {
            $orders = HoaDon::where('khach_hang_id', Session('login'))->orderBy('id', 'asc')->get();
            // dd($orders);
            return view('pages.taikhoan.donhang', compact('orders'));
        } else {
            $hoadon = HoaDon::where('khach_hang_id', Auth::user()->khach_hang->id)->orderBy('id', 'asc')->get();
            // dd($hoadon);
            return view('pages.taikhoan.donhang', compact('hoadon'));
        }
        // dd($orders);
    }

    public function getHuy($id)
    {
        $hd = HoaDon::find($id);
        $hd->status = -1;
        $hd->update();

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

        return redirect()->back();
    }

    public function getAdminProfile()
    {
        return view('admin.Profile.index');
    }

    public function postAdminProfile(Request $request){
        // $users = User::find(Auth::user()->admin->id);
        $this->validate($request, [
            'ho_ten' => 'required',
            'dien_thoai' => 'required|numeric|min:10',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required',
            'dia_chi' => 'required',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ tên!',
            'dien_thoai.required' => 'Vui lòng nhập số điện thoại!',
            'dien_thoai.numeric' => 'Số điện thoại không hợp lệ!',
            'dien_thoai.min' => 'Số điện thoại phải có ít nhất 10 số!',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh!',
            'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
            'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
            'gioi_tinh.required' => 'Vui lòng nhập giới tính!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
        ]);
        $nhanvien = Admin::find(Auth::user()->admin->id);
        // foreach ($nhanvien as $nv) {
            $nhanvien->ho_ten = $request->ho_ten;
            $nhanvien->dien_thoai = $request->dien_thoai;
            $nhanvien->ngay_sinh = $request->ngay_sinh;
            $nhanvien->gioi_tinh = $request->gioi_tinh;
            $nhanvien->dia_chi = $request->dia_chi;
            $nhanvien->save();
        // }
        return redirect()->back()->with('thongbao', 'Thay đổi thông tin thành công!');
    }

    public function getAdminPassword()
    {
        return view('admin.Profile.doimatkhau');
    }

    public function postAdminPassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ], [
            'oldPassword.required' => 'Bạn chưa nhập mật khẩu cũ!',
            'password.required' => 'Bạn chưa nhập mật khẩu mới!',
            'password.min' => 'Mật khẩu phải có tối thiểu 6 ký tự!',
            'confirmPassword.required' => 'Xác nhận mật khẩu không được để trống!',
            'confirmPassword.same' => 'Xác nhận mật khẩu không chính xác!',
        ]);

        $user = Auth::user();
        if (!(Hash::check($request->oldPassword, $user->password))) {
            return redirect()->back()->with('thongbao', 'Mật khẩu cũ không chính xác!');
        } elseif (strcmp($request->oldPassword, $request->password) === 0) {
            return redirect()->back()->with('thongbao', 'Mật khẩu mới trùng với mật khẩu cũ!');
        }
        $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->back()->with('thanhcong', 'Mật khẩu đã được thay đổi thành công!');
    }
}

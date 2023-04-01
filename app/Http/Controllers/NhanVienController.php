<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NhanVienExport;

class NhanVienController extends Controller
{
    public function index()
    {
        $nhanvien = User::where('role', 2)->orderBy('id', 'asc')->get();
        // dd($nhanvien);
        $nhanviens = Admin::orderBy('id', 'asc')->get();
        return view('admin.NhanVien.index', compact('nhanvien'));
    }

    public function getThem()
    {
        return view('admin.NhanVien.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'ho_ten' => 'required',
            'email' => 'required|unique:users,email',
            'dien_thoai' => 'required|numeric|min:10',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required',
            'dia_chi' => 'required',
            'password' => 'required|min:6',
            'passwordAgain' => 'required|same:password',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ tên!',
            'email.required' => 'Vui lòng nhập email!',
            'email.unique' => 'Email đã tồn tại!',
            'dien_thoai.required' => 'Vui lòng nhập số điện thoại!',
            'dien_thoai.numeric' => 'Nhập số điện thoại không hợp lệ!',
            'dien_thoai.min' => 'Số điện thoại phải có ít nhất 10 số!',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh!',
            'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
            'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay',
            'gioi_tinh.required' => 'Vui lòng nhập giới tính!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự!',
            'passwordAgain.required' => 'Vui lòng xác nhận mật khẩu!',
            'passwordAgain.same' => 'Xác nhận mật khẩu không chính xác!',
        ]);

        $user = new User();
        $user->role = 2;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->ho_ten;
        $user->status = 'active';
        $user->save();

        $nhanvien = new Admin();
        $nhanvien->user_id = $user->id;
        $nhanvien->ho_ten = $request->ho_ten;
        $nhanvien->gioi_tinh = $request->gioi_tinh;
        $nhanvien->ngay_sinh = $request->ngay_sinh;
        $nhanvien->dia_chi = $request->dia_chi;
        $nhanvien->dien_thoai = $request->dien_thoai;
        $nhanvien->save();
        return redirect()->back()->with('thongbao', 'Đã thêm nhân viên thành công!');
    }

    public function getSua($id)
    {
        $users = User::find($id);
        return view('admin.NhanVien.sua', compact('users'));
    }

    public function postSua(Request $request, $id)
    {
        $users = User::find($id);
        $this->validate($request, [
            'ho_ten' => 'required',
            'dien_thoai' => 'required|numeric|min:10',
            'ngay_sinh' => 'required|date|before:today',
            'gioi_tinh' => 'required',
            'dia_chi' => 'required',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ tên!',
            'dien_thoai.required' => 'Vui lòng nhập số điện thoại!',
            'dien_thoai.numeric' => 'Nhập số điện thoại không hợp lệ!',
            'dien_thoai.min' => 'Số điện thoại phải có ít nhất 10 số!',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh!',
            'ngay_sinh.date' => 'Nhập ngày sinh không hợp lệ!',
            'ngay_sinh.before' => 'Ngày sinh không được lớn hơn ngày hôm nay!',
            'gioi_tinh.required' => 'Vui lòng nhập giới tính!',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ!',
        ]);
        $nhanvien = Admin::where('user_id', $id)->get();
        foreach ($nhanvien as $nv) {
            $nv->ho_ten = $request->ho_ten;
            $nv->dien_thoai = $request->dien_thoai;
            $nv->ngay_sinh = $request->ngay_sinh;
            $nv->gioi_tinh = $request->gioi_tinh;
            $nv->dia_chi = $request->dia_chi;
            $nv->save();
        }
        return redirect()->route('admin.nhanvien.index')->with('thongbao', 'Sửa thành công!');
    }

    public function resetPass($id)
    {
        $users = User::find($id);
        $users->password = bcrypt('123456');
        $users->save();
        return redirect()->back()->with('thongbao', 'Đã đặt mật khẩu mặc định!');
    }

    public function xoa($id)
    {
        $nhanvien = Admin::where('user_id', $id)->get();
        foreach ($nhanvien as $nv) {
            $nv->delete();
        }
        User::destroy($id);
        return redirect()->back()->with('thongbao', 'Xoá thành công!');
    }

    public function export(){
        return Excel::download(new NhanVienExport(), 'nhanvien.xlsx');
    }
}

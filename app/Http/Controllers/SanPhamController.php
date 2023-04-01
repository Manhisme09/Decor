<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Models\SanPham;
use Illuminate\Support\Str;

class SanPhamController extends Controller
{
    public function index()
    {
        $sanpham = SanPham::orderBy('id', 'asc')->get();
        return view('admin.SanPham.index', compact('sanpham'));
    }

    public function getThem()
    {
        $danhMuc = DanhMuc::where('parent_id', '!=', 0)->get();
        return view('admin.SanPham.them', compact('danhMuc'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'danh_muc_id' => 'required',
            'ten_san_pham' => 'required|unique:san_pham,ten_san_pham',
            'so_luong' => 'required|numeric|min:1',
            'gia_ban' => 'required|numeric|min:0',
            'hinh_anh' => 'required',
        ], [
            'danh_muc_id.required' => 'Vui lòng chọn danh mục !',
            'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm !',
            'ten_san_pham.unique' => 'Tên sản phẩm này đã tồn tai !',
            'so_luong.required' => 'Vui lòng nhập số lượng !',
            'so_luong.numeric' => 'Bạn phải nhập số !',
            'so_luong.min' => 'Số lượng phải lớn hơn 0',
            'gia_ban.required' => 'Vui lòng nhập giá bán',
            'gia_ban.numeric' => 'Vui lòng nhập số!',
            'gia_ban.min' => 'Giá bán không được nhỏ hơn 0!',
            'hinh_anh.required' => 'Vui lòng chọn hình ảnh!',
        ]);

        $sanpham = new SanPham();
        $sanpham->danh_muc_id = $request->danh_muc_id;
        $sanpham->ten_san_pham = $request->ten_san_pham;
        $sanpham->slug = \Str::slug($request->ten_san_pham);
        $sanpham->so_luong = $request->so_luong;
        $sanpham->gia_ban = $request->gia_ban;
        $sanpham->thuoc_tinh = $request->thuoc_tinh;
        $sanpham->mo_ta = $request->mo_ta;

        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            while (file_exists("images/product/" . $hinh)) {
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            }
            $file->move("images/product", $hinh);
            $sanpham->hinh_anh = "images/product/" . $hinh;
        }
        $sanpham->save();
        return redirect()->back()->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id)
    {
        $danhmuc = DanhMuc::where('parent_id', '!=', 0)->get();
        $sanpham = SanPham::find($id);
        return view('admin.SanPham.sua', compact('danhmuc', 'sanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $sanpham = SanPham::find($id);
        $this->validate($request, [
            'danh_muc_id' => 'required',
            'ten_san_pham' => 'required',
            'so_luong' => 'required|numeric|min:1',
            'gia_ban' => 'required|numeric|min:0',
        ], [
            'danh_muc_id.required' => 'Vui lòng chọn danh mục !',
            'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm !',
            'ten_san_pham.unique' => 'Tên sản phẩm này đã tồn tai !',
            'so_luong.required' => 'Vui lòng nhập số lượng !',
            'so_luong.numeric' => 'Bạn phải nhập số !',
            'so_luong.min' => 'Số lượng phải lớn hơn 0',
            'gia_ban.required' => 'Vui lòng nhập giá bán',
            'gia_ban.numeric' => 'Vui lòng nhập số!',
            'gia_ban.min' => 'Giá bán không được nhỏ hơn 0!',
        ]);
        $sanpham->danh_muc_id = $request->danh_muc_id;
        $sanpham->ten_san_pham = $request->ten_san_pham;
        $sanpham->slug = \Str::slug($request->ten_san_pham);
        $sanpham->so_luong = $request->so_luong;
        $sanpham->gia_ban = $request->gia_ban;
        $sanpham->thuoc_tinh = $request->thuoc_tinh;
        $sanpham->mo_ta = $request->mo_ta;

        if ($request->hasFile('hinh_anh')) {
            $destinationPath = $sanpham->hinh_anh;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
            $file = $request->file('hinh_anh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            while (file_exists("images/product/" . $hinh)) {
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            }
            $file->move("images/product", $hinh);
            $sanpham->hinh_anh = "images/product/" . $hinh;
        }
        $sanpham->save();
        return redirect()->route('admin.SanPham.index')->with('thongbao', 'Sửa thành công!');
    }

    public function getXoa($id)
    {
        $sanpham = SanPham::find($id);
        $hoadon = ChiTietHoaDon::where('san_pham_id', $id)->get();
        if (empty($hoadon[0])) {
            $destinationPath = $sanpham->hinh_anh;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
            $sanpham->delete();
            return redirect()->back()->with('thongbao', 'Xoá thành công');
        } else {
            return redirect()->back()->with('loi', 'Sản phẩm này đang tồn tại trong hoá đơn. Không thể xoá');
        }
    }
}

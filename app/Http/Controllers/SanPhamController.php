<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Image;
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
            'ten_san_pham.unique' => 'Tên sản phẩm này đã tồn tại !',
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

        $sanpham->save(); // Lưu sản phẩm để nhận ID mới

        if ($request->hasFile('hinh_anh')) {
            foreach ($request->file('hinh_anh') as $file) {
                $name = $file->getClientOriginalName();
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
                while (file_exists("images/product/" . $hinh)) {
                    $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
                }
                $file->move("images/product", $hinh);

                // Lưu đường dẫn vào bảng "images" của sản phẩm
                $image = new Image();
                $image->product_id = $sanpham->id; // Sử dụng ID mới của sản phẩm
                $image->url = "images/product/" . $hinh;
                $image->save();
            }
        }

        return redirect()->back()->with('thongbao', 'Thêm thành công');
    }


    public function getSua($id)
    {
        $danhmuc = DanhMuc::where('parent_id', '!=', 0)->get();
        $sanpham = SanPham::find($id);
        $images = Image::where('product_id', $id)->get();
        return view('admin.SanPham.sua', compact('danhmuc', 'sanpham', 'images'));
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
            // Xóa hình ảnh cũ
            $imageOld = Image::where('product_id', $id)->get();
            foreach ($imageOld as $image) {
                $destinationPath = $image->url;
                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }
                $image->delete();
            }

            // Tải lên và lưu hình ảnh mới
            foreach ($request->file('hinh_anh') as $file) {
                $name = $file->getClientOriginalName();
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
                while (file_exists("images/product/" . $hinh)) {
                    $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
                }
                $file->move("images/product", $hinh);

                // Lưu đường dẫn vào bảng "images" của sản phẩm
                $image = new Image();
                $image->product_id = $sanpham->id;
                $image->url = "images/product/" . $hinh;
                $image->save();
            }
        }
        $sanpham->save();
        return redirect()->route('admin.SanPham.index')->with('thongbao', 'Sửa thành công!');
    }

    public function getXoa($id)
    {
        $sanpham = SanPham::find($id);
        $hoadon = ChiTietHoaDon::where('san_pham_id', $id)->get();
        if (empty($hoadon[0])) {
            $imageOld = Image::where('product_id', $id)->get();
            foreach ($imageOld as $image) {
                $destinationPath = $image->url;
                if (file_exists($destinationPath)) {
                    unlink($destinationPath);
                }
                $image->delete();
            }
            $sanpham->delete();
            return redirect()->back()->with('thongbao', 'Xoá thành công');
        } else {
            return redirect()->back()->with('loi', 'Sản phẩm này đang tồn tại trong hoá đơn. Không thể xoá');
        }
    }
}

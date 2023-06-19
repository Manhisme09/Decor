<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class BaiVietController extends Controller
{
    public function index()
    {
        $baiviet = BaiViet::orderBy('id', 'asc')->get();
        return view('admin.BaiViet.index', compact('baiviet'));
    }

    public function getThem()
    {
        return view('admin.BaiViet.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'hinh_anh' => 'required',
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ], [
            'hinh_anh.required' => 'Bạn chưa thêm ảnh!',
            'tieu_de.required' => 'Bạn chưa nhập tiêu đề',
            'noi_dung.required' => 'Bạn chưa nhập nội dung!',
        ]);

        $baiviet = new BaiViet();
        $baiviet->tieu_de = $request->tieu_de;
        $baiviet->noi_dung = $request->noi_dung;
        $baiviet->trang_thai = $request->trang_thai;
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            while (file_exists("images/baiviet/" . $hinh)) {
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            }
            $file->move("images/baiviet/", $hinh);
            $baiviet->image = "images/baiviet/" . $hinh;
        }

        $baiviet->save();
        Toastr::success('Thêm bài viết thành công!', 'Thành công');
        return redirect()->back();
    }

    public function getSua($id)
    {
        $baiviet = BaiViet::find($id);
        return view('admin.BaiViet.sua', compact('baiviet'));
    }

    public function postSua(Request $request, $id)
    {
        $baiviet = BaiViet::find($id);
        $this->validate($request, [
            'tieu_de' => 'required',
            'noi_dung' => 'required',
        ], [
            'tieu_de.required' => 'Bạn chưa nhập tiêu đề',
            'noi_dung.required' => 'Bạn chưa nhập nội dung!',
        ]);

        $baiviet->tieu_de = $request->tieu_de;
        $baiviet->noi_dung = $request->noi_dung;
        $baiviet->trang_thai = $request->trang_thai;
        if ($request->hasFile('hinh_anh')) {
            $destinationPath = $baiviet->image;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
            $file = $request->file('hinh_anh');
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            while (file_exists("images/baiviet/" . $hinh)) {
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            }
            $file->move("images/baiviet/", $hinh);
            $baiviet->image = "images/baiviet/" . $hinh;
        }

        $baiviet->save();
        Toastr::success('Sửa bài viết thành công!', 'Thành công');
        return redirect()->route('admin.baiviet.index');
    }

    public function xoa($id)
    {
        $baiviet = BaiViet::find($id);
        $destinationPath = $baiviet->image;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $baiviet->delete();
        Toastr::success('Xóa bài viết thành công!', 'Thành công');
        return redirect()->back();
    }
}

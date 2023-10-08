<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\HoaDon;
use App\Models\SanPham;
use Illuminate\Support\Str;
use Mpdf\Tag\Em;
use Brian2694\Toastr\Facades\Toastr;

class DanhMucController extends Controller
{
    public function index($parent_id = 1)
    {
        $danhmuc = DanhMuc::when($parent_id == 0, function ($query) use ($parent_id) {
            $query->where('parent_id', $parent_id);
        })->get();
        return view('admin.DanhMuc.index', compact('danhmuc'));
    }

    public function getThem()
    {
        $parents = DanhMuc::where('parent_id', 0)->get();
        return view('admin.DanhMuc.them', compact('parents'));
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'ten_danh_muc' => 'required',
            'parent_id' => 'required',
        ], [
            'ten_danh_muc.required' => 'Bạn chưa nhập tên danh mục!',
            'parent_id.required' => 'Bạn chưa chọn loại danh mục!',
        ]);
        $danhmuc = new DanhMuc();
        $danhmuc->ten_danh_muc = $request->ten_danh_muc;
        $danhmuc->parent_id = $request->parent_id;
        $danhmuc->slug = Str::slug($request->ten_danh_muc);
        $danhmuc->save();
        Toastr::success('Thêm danh mục thành công!', 'Thành công');
        return redirect()->back();
    }

    public function getSua($id)
    {
        $danhmuc = DanhMuc::find($id);
        $parents = DanhMuc::where('parent_id', 0)->get();
        return view('admin.DanhMuc.sua', compact('parents', 'danhmuc'));
    }

    public function postSua(Request $request, $id)
    {
        $this->validate($request, [
            'ten_danh_muc' => 'required',
            'parent_id' => 'required',
        ], [
            'ten_danh_muc.required' => 'Bạn chưa nhập tên danh mục!',
            'parent_id.required' => 'bạn chưa chọn loại danh mục!',
        ]);
        $danhmuc = DanhMuc::find($id);
        $danhmuc->ten_danh_muc = $request->ten_danh_muc;
        $danhmuc->parent_id = $request->parent_id;
        $danhmuc->slug = Str::slug($request->ten_danh_muc);
        $danhmuc->save();
        Toastr::success('Sửa danh mục thành công!', 'Thành công');
        return redirect()->route('admin.DanhMuc.index');
    }

    public function getXoa($id)
    {
        $danhmuc = DanhMuc::with('san_pham.chi_tiet_hoa_don')->find($id);
        $parents = DanhMuc::where('parent_id', $id)->first();

        foreach ($danhmuc->san_pham as $item) {
            foreach ($item->chi_tiet_hoa_don as $chitiet) {
            }
        }
        if ($danhmuc) {
            if (empty($parents) && empty($item)) {
                DanhMuc::where('id', $id)->orwhere('parent_id', $id)->delete();
                return redirect()->back()->with('thongbao', 'Đã xoá danh mục!');
            } else {
                if (empty($chitiet) && !empty($item)) {
                    $parent = DanhMuc::with('san_pham')->where('id', $id)->orwhere('parent_id', $id)->get();
                    foreach ($parent as $pt) {
                        foreach ($pt->san_pham as $sp) {
                            $sp->delete();
                        }
                        $pt->delete();
                    }
                    return redirect()->back()->with('thongbao', 'Đã xoá danh mục!');
                } elseif(!empty($chitiet)) {
                    return redirect()->back()->with('loi', 'Không thể xoá danh mục. Danh mục chứa sản phẩm trong hoá đơn!');
                }
                else{
                    return redirect()->back()->with('loi','Không thể xoá danh mục. Danh mục này chứa các danh mục con');
                }
                // elseif(!empty($parents)){
                //     return redirect()->back()->with('loi', 'Không thể xoá danh mục. Danh mục này có chứa các danh mục con!');
                // }
            }
        }
        // $parent = DanhMuc::with('san_pham.chi_tiet_hoa_don')->where('parent_id', $id)->get();


        // $sanpham = SanPham::where('danh_muc_id', $id)->get();
        // $danhmuc = DanhMuc::where('id',$id)->get();
        //     $parent = DanhMuc::with('san_pham.chi_tiet_hoa_don')->where('parent_id', '!=', 0)->get();
        // //  dd($parent);
        //     foreach ($parent as $item) {
        //         $sanpham = SanPham::where('danh_muc_id', $item)->get();
        //         dd($sanpham);
        //         // foreach ($item->san_pham ?? [] as $sp) {
        //         //     dd($sp);
        //         //     foreach($sp->chi_tiet_hoa_don as $chi_tiet){
        //         //         dd($chi_tiet);
        //         //     }
        //         // }
        //     }
        //     if(!empty($chi_tiet)){
        //         dd(1);
        //         $sp->delete();
        //         $item->delete();
        //         DanhMuc::destroy($id);
        //         return redirect()->back()->with('thongbao', 'Đã xoá danh mục!');
        //     }
        //     else{
        //         dd(2);
        //         return redirect()->back()->with('loi', 'Không thể xoá. Danh mục có chứa sản phẩm nằm trong hoá đơn!');
        //     }
    }
}

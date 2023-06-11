<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\BinhLuan;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\LienHe;
use App\Models\Slide;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $topProduct = SanPham::where('da_ban', '>', 10)->get();
        $allProduct = SanPham::paginate(12,['*'],'pag');
        $slide = Slide::all();
        $posts = BaiViet::where('trang_thai', 1)->paginate(3);
        return view('pages.index', compact('topProduct', 'allProduct', 'posts', 'slide'));
    }

    public function getProduct($id)
    {
        $sanPham = SanPham::where('danh_muc_id', $id)->get();
        $danhMuc = DanhMuc::where('id', $id)->first();
        $listDanhmuc = DanhMuc::where('parent_id', '!=', 0)->get();
        $topSanpham = SanPham::where('da_ban', '>', 10)->get();
        // dd($sanPham['0']);
        return view('pages.product', compact('sanPham', 'danhMuc', 'listDanhmuc', 'topSanpham'));
    }

    public function getProductDetail($slug,$id)
    {
        $binhluan = BinhLuan::where('san_pham_id', $id)->get();
        $chiTiet = SanPham::find($id);
        $listDanhmuc = DanhMuc::where('parent_id', '!=', 0)->get();
        $tuongTu = SanPham::where('danh_muc_id', '=', $chiTiet->danh_muc_id)->get();
        $images = Image::where('product_id', $id)->get();
        return view('pages.product_detail', compact('chiTiet', 'listDanhmuc', 'tuongTu', 'binhluan', 'images'));
    }

    public function gioiThieu()
    {
        return view('pages.gioithieu');
    }

    public function getLienhe()
    {
        return view('pages.lienhe');
    }

    public function getCskh()
    {
        return view('pages.cskh');
    }

    public function postCskh(Request $request)
    {
        $this->validate($request, [
            'ho_ten' => 'required',
            'email' => 'required',
            'dien_thoai' => 'required|numeric|min:10',
            'noi_dung' => 'required',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ tên của bạn',
            'email.required' => 'Vui lòng nhập email của bạn',
            'dien_thoai.required' => 'Vui lòng nhập số điện thoại',
            'dien_thoai.numeric' => 'Ký tự số điện thoại không hợp lệ. Yêu cầu nhập số',
            'dien_thoai.min' => 'Số điện thoại phải có ít nhất 10 ký tự',
            'noi_dung.required' => 'Vui lòng nhập nội dung cần hỗ trợ',
        ]);
        $cskh = new LienHe();
        $cskh->ho_ten = $request->ho_ten;
        $cskh->email = $request->email;
        $cskh->dien_thoai = $request->dien_thoai;
        $cskh->noi_dung = $request->noi_dung;
        $cskh->save();
        return redirect()->back()->with('thongbao', 'Gửi yêu cầu thành công!');
    }

    public function postComment(Request $request, $id)
    {
        $comment = new BinhLuan();
        $comment->noi_dung = $request->noi_dung;
        $comment->user_id = Auth::user()->id;
        $comment->san_pham_id = $id;
        $comment->save();
        return redirect()->back();
    }

    public function Posts()
    {
        $baiviet = BaiViet::paginate(40);
        return view('pages.BaiViet.baiviet', compact('baiviet'));
    }

    public function postDetail($id)
    {
        $post_detail = BaiViet::find($id);
        // dd($post_detail);
        return view('pages.BaiViet.chitietbaiviet', compact('post_detail'));
    }


    public function search(Request $request)
    {
        $menu = DanhMuc::all();
        $sanPham = SanPham::where('ten_san_pham', 'like', '%' . $request->keyname . '%')
            ->orwhere('gia_ban', $request->keyname)->get();
        // dd($sanPham);
        return view('pages.search', compact('sanPham', 'menu'));
    }
}

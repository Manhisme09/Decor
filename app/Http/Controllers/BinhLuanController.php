<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class BinhLuanController extends Controller
{
    public function index()
    {
        $binhluan = BinhLuan::orderBy('id', 'asc')->get();
        return view('admin.BinhLuan.index', compact('binhluan'));
    }

    public function deleteComment($id)
    {
        BinhLuan::destroy($id);
        Toastr::success('Xóa bình luận thành công!', 'Thành công');
        return redirect()->back();
    }

    public function getRelyComment($id)
    {
        $comment = BinhLuan::find($id);
        return view('admin.BinhLuan.traloi', compact('comment'));
    }

    public function postRelyComment(Request $request, $id)
    {
        $this->validate($request, [
            'noi_dung' => 'required',
        ],[
            'noi_dung.required' => 'Bạn chưa nhập câu trả lời',
        ]);
        $comment_kh = BinhLuan::find($id);
        $comment = new BinhLuan();
        $comment->user_id = Auth::user()->id;
        $comment->san_pham_id = $comment_kh->san_pham_id;
        $comment->nguon_binh_luan = $comment_kh->id;
        $comment->status = 1;
        $comment->noi_dung = $request->noi_dung;
        $comment->save();
        Toastr::success('Gửi bình luận thành công!', 'Thành công');
        return redirect()->route('admin.binhluan.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect()->back()->with('thongbao', 'Đã xoá bình luận');
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
        return redirect()->route('admin.binhluan.index')->with('thongbao', 'Gửi phản hồi thành công');
    }
}

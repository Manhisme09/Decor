<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    public function index()
    {
        $slide = Slide::orderBy('id', 'asc')->get();
        return view('admin.slide.index', compact('slide'));
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request, [
            'hinh_anh' => 'required'
        ], [
            'hinh_anh.required' => 'Bạn chưa tải ảnh lên',
        ]);
        $slide = new Slide();
        $slide->ten_slide = $request->ten_slide;
        if ($request->hasFile("hinh_anh")) {
            $file = $request->file("hinh_anh");
            $name = $file->getClientOriginalName();
            $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            while (file_exists("images/slide/" . $hinh)) {
                $hinh = Str::random(5) . "_" . Str::random(5) . "_" . $name;
            }
            $file->move("images/slide/", $hinh);
            $slide->image = "images/slide/" . $hinh;
        }
        $slide->save();
        return redirect()->back()->with('thongbao', 'Đã thêm mới slide');
    }

    public function xoa($id)
    {
        $slide = Slide::find($id);
        $destinationPath = $slide->image;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $slide->delete();
        return redirect()->back()->with('thongbao', 'Đã xoá slide');
    }
}

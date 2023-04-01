<?php

namespace App\Http\Controllers;

use App\Models\LienHe;
use Illuminate\Http\Request;

class CskhContoller extends Controller
{
    public function index()
    {
        $cskh = LienHe::orderBy('id', 'asc')->get();
        return view('admin.cskh.index', compact('cskh'));
    }

    public function repFeedback($id){
        $lien_he = LienHe::find($id);
        $lien_he->status = 1;
        $lien_he->update();
        return redirect()->back()->with('thongbao', 'Đã cập nhật trạng thái');
    }
}

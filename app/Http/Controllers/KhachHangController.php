<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function index()
    {
        $khachhang = User::where('role', 5)->where('status', 'active')->orderBy('id', 'asc')->get();
        return view('admin.KhachHang.index', compact('khachhang'));
    }
}

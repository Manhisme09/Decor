<?php

namespace App\Http\Controllers;

use App\Exports\ThongKeExport;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use DB;
use Illuminate\Support\Facades\Date;
use Excel;

class ThongKeController extends Controller
{
    public function index()
    {
        $month = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
        $hoadon = [];
        $selectedYear = request('selectedYear');
        if (!$selectedYear) {
            $year = 2023;
        } else {
            $year = $selectedYear;
        }
        foreach ($month as $key => $value) {
            $hoadon[] = HoaDon::where(DB::raw("month(ngay_lap)"), $value)->whereYear('ngay_lap', $year)->where('status', 3)->sum('tong_tien');
        }
        $tong_tien = HoaDon::select('ngay_lap',\DB::raw('sum(tong_tien) as tong'))->groupBy('ngay_lap')->where('status', 3)->get();
        return view('admin.ThongKe.index', compact('tong_tien'))->with('selectedYear', $year)->with('month', json_encode($month, JSON_NUMERIC_CHECK))->with('hoadon', json_encode($hoadon, JSON_NUMERIC_CHECK));
    }

    public function export(){
        return Excel::download(new ThongKeExport(), 'danhsach.xlsx');
    }

}

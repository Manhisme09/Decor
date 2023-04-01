<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\HoaDon;
use Maatwebsite\Excel\Concerns\FromView;

class ThongKeExport implements FromView
{
    public function view(): View
    {
        $tong_tien = HoaDon::select('ngay_lap',\DB::raw('sum(tong_tien) as tong'))->groupBy('ngay_lap')->where('status', 3)->get();
        return view('admin.ThongKe.export',compact('tong_tien'));
    }
}

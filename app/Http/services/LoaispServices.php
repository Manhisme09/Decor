<?php
namespace App\Http\services;

use App\Models\LoaiSanPham;

class LoaispServices{
    public function get(){
        return LoaiSanPham::orderBy('id', 'asc');
    }

    public function insert($request){
        $this->validate($request,[

        ]);
    }
}
?>
